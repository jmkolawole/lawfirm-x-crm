<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use Validator;
use Illuminate\Routing\UrlGenerator;
use File;
use Illuminate\Support\Facades\Mail;


class ClientController extends Controller
{
    //
    
    protected $client;
    protected $base_url;

    public function __construct(UrlGenerator $urlGenerator){
        $this->client = new Client;
        $this->base_url = $urlGenerator->to("/");
    }


    //The function adds a new contact
    public function add(Request $request){

        
        $validator = Validator::make($request->all(),[
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string'
       ]);
       
       if($validator->fails()){
        return response()->json([
            'success' => false,
            'message' => $validator->messages()->toArray()
         ], 500);
       }
       
       $profile_picture = $request->profile_image;
       $file_name = "";
       if($profile_picture == null){
           $file_name = "default-avatar.png";
       }else{
           $generate_name = uniqid()."_".time().date('Ymd')."_IMG";
           
           $base64Image = $profile_picture;
           
           $fileBin = file_get_contents($base64Image);

           $mimeType = mime_content_type($base64Image);
           //Ensure only images files are uploaded
           if("image/png" == $mimeType){
               $file_name = $generate_name.".png";
           }else if("image/jpeg" == $mimeType){
            $file_name = $generate_name.".jpeg";
            }
            else if("image/jpg" == $mimeType){
                $file_name = $generate_name.".jpg";
            }else{
                return response()->json([
                    'success' => false,
                    'message' => "only PNG, JPG and JPEG files are accepted as profile pictures"
                 ], 500);
            }

       }

     


       $this->client->firstname = $request->firstname;
       $this->client->lastname = $request->lastname;
       $this->client->email = $request->email;
       $this->client->primary_legal_counsel = $request->primary_legal_counsel;
       $this->client->dob = $request->dob;
       $this->client->case_details = $request->case_details;
       $this->client->profile_image = $file_name;
             
       $this->client->save();
       //Send mail upon creating a profile
       Mail::to($this->client->email)->send(new \App\Mail\Client($this->client));
       
       if($profile_picture == null){
                   
       }else{
           file_put_contents('./profile_images/'.$file_name, $fileBin);
       }

       return response()->json([
        'success' => true,
        'message' => "client saved successfully"
     ], 200);

    }


    
    public function getClients(){

        $file_directory = $this->base_url.'/profile_images';

        $data = $this->client::get();

        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Error fetching clients'
             ], 500);
        }


        //If contact actually exist
        return response()->json([
            'success' => true,
            'data' => $data,
            'file_directory' => $file_directory

         ], 200);

    }

    public function getSingleClient($id=null){
        $file_directory = $this->base_url.'/profile_images';

        $findData = $this->client::find($id);

        if(!$findData){
            return response()->json([
                'success' => false,
                'message' => 'This client does not exist'
             ], 500);
        }


        //If client actually exist
        return response()->json([
            'success' => true,
            'data' => $findData,
            'file_directory' => $file_directory

         ], 200);

    }


    /*
    public function editSingleClient(Request $request, $id=null){
        $validator = Validator::make($request->all(),[
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string'
         ]);
 
         if($validator->fails()){
             return response()->json([
                 'success' => false,
                 'message' => $validator->messages()->toArray()
              ], 500);
            }
     
            
         $findData = $this->client::find($id); 
         if(!$findData){
             return response()->json([
                 'success' => false,
                 'message' => 'This client does not exist'
              ], 500);
         }
         
         //If image is the default one, do nothing, else delete the image from the system
         $getFile = $findData->image_file;
         $getFile == "default-avatar.png" ? : File::delete('profile_images/'.$getFile);
 
         $profile_picture = $request->profile_image;
        $file_name = "";
        if($profile_picture == null){
            $file_name = "default-avatar.png";
        }else{
            $generate_name = uniqid()."_".time().date('Ymd')."_IMG";
            
            $base64Image = $profile_picture;
            
            $fileBin = file_get_contents($base64Image);
            
            $mimeType = mime_content_type($base64Image);
            if("image/png" == $mimeType){
                $file_name = $generate_name.".png";
            }else if("image/jpeg" == $mimeType){
             $file_name = $generate_name.".jpeg";
             }
             else if("image/jpg" == $mimeType){
                 $file_name = $generate_name.".jpg";
             }else{
                 return response()->json([
                     'success' => false,
                     'message' => "only PNG, JPG and JPEG files are accepted as profile pictures"
                  ], 500);
             }
 
        }
 
        $findData->firstname = $request->firstname;
        $findData->lastname = $request->lastname;
        $findData->email = $request->email;
        $findData->primary_legal_counsel = $request->primary_legal_counsel;
        $findData->dob = $request->dob;
        $findData->case_details = $request->case_details;
        $findData->profile_image = $file_name;
       
        $findData->save();

 
 
     if($profile_picture == null){
 
     }else{
         file_put_contents('./profile_images/'.$file_name, $fileBin);
     }
 
     return response()->json([
      'success' => true,
      'message' => "client details updated successfully"
   ], 200);
    }

    */



    /*
    public function deleteClient($id = null){
        $findData = $this->client::find($id);

        if(!$findData){
            return response()->json([
                'success' => false,
                'message' => 'This client does not exist'
             ], 500);
        }

        $getFile = $findData->image_file;
        if($findData->delete()){
            //If image is default, leave as it is or do nothing, if image exist, then delete
            $getFile == "default-avatar.png" ? : File::delete('profile_images/'.$getFile);
                return response()->json([
                    'success' => true,
                    'message' => 'Contact deleted successfully'
                 ], 500);
            
        }
    
    }


    public function searchClient($search=null){
        $file_directory = $this->base_url.'/profile_images';

        $search_query = $this->client::Where("lastname","LIKE","%$search%")->orderBy("id","DESC")->get()->toArray();
        return response()->json([
            'success' => true,
            'data' => $search_query,
            'file_directory' => $file_directory

         ], 200);

    }


    

    */


    



}
