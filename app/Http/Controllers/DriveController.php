<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Google_Client;
use Google_Service_Drive;
use App\Models\Post;
use Storage;
use Illuminate\Support\Facades\DB;

class DriveController extends Controller
{
    protected $client;

    public function __construct(Google_Client $client)
    {
        $this->client = $client->getClient();
    }
    const DRIVE_CONFIG_URL = ' https://docs.google.com/uc?id=';


    public function store(Request $request)
    {
        $imageID = "";
        if ($request->hasFile('raw_image')) {
            $imageID = $this->getImageID($request->file('raw_image'));
        }
        Post::create(array_merge($request->all(), [
            'content' => $request->content,
            'image' => $imageID,
            'user_id' => 2
        ]));
    }
    private function getImageID($image)
    {
        $driveService = new Google_Service_Drive($this->client);

        try {
            $fileMetadata = new \Google_Service_Drive_DriveFile([
                'name' => time().'.'.$image->getClientOriginalExtension(),
            ]);
            $file = $driveService->files->create($fileMetadata, [
                'data' => file_get_contents($image->getRealPath()),
                'uploadType' => 'multipart',
                'fields' => 'id',
            ]);
            // bắt đầu phân quyền
            $driveService->getClient()->setUseBatch(true);
    
            try {
                $batch = $driveService->createBatch();
                $userPermission = new \Google_Service_Drive_Permission([
                    //dành cho mọi người
                    'type' => 'anyone', // user | group | domain | anyone
                    // và chỉ được quyền xem
                    'role' => 'reader', // organizer | owner | writer | commenter | reader
                ]);
                $request = $driveService->permissions->create($file->id, $userPermission, ['fields' => 'id']);
                $batch->add($request, 'user');
                $results = $batch->execute();
                //test xong nhớ xóa dòng dưới này đi
            } catch (\Exception $e) {
    
            } finally {
                $driveService->getClient()->setUseBatch(false);
            }
            return $file->id;
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function index()
    {
        $data['posts'] = Post::all()->map(function($item) {
            return [
                'image' => self::DRIVE_CONFIG_URL.$item->image,
                'content' => $item->content,
                'user_id' => 2
            ];
        });

        return view('testapigg', $data);
    }

}
