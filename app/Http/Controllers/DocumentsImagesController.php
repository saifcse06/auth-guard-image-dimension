<?php

namespace App\Http\Controllers;

use App\DocumentsImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class DocumentsImagesController extends Controller
{
    //

    public function create()
    {
        $data['title'] = "Save New File";
        return view('customer.document_image.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'title' => 'required',
            'file_path' => 'required|mimes:pdf,docx,xlxs,pptx'

        ]);

        $name = null;
        if ($request->hasfile('file_path')) {

            $file = $request->file('file_path');
            $name = $file->getClientOriginalName();
            $file->move(public_path() . '/files/', $name);
        }
        $file = new DocumentsImages();
        $file->title = $request->title;
        $file->file_path = $name;
        $file->customer_id = Auth::user()->id;
        $file->file_data = $request->file_path;
        $file->file_type = DocumentsImages::FILE_DOC;
        $file->save();
        return redirect('list/files')->with('success', 'Data Your files has been successfully added');

    }

    public function image()
    {
        $data['title'] = "Save New File";
        return view('customer.document_image.image', $data);
    }

    public function storeImage(Request $request)
    {
        $this->validate($request, [

            'title' => 'required',
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        $name = null;
        if ($request->hasfile('file_path')) {
            $file = $request->file('file_path');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/images/', $name);
        }
        $file = new DocumentsImages();
        $file->title = $request->title;
        $file->file_path = $name;
        $file->customer_id = Auth::user()->id;
        $file->file_data = $request->file_path;
        $file->file_type = DocumentsImages::FILE_IMAGE;
        $file->save();
        return redirect('list/images')->with('success', 'Data Your files has been successfully added');

    }

    public function allImages()
    {
        $data['title'] = "All Images";
        $data['allImages'] = DocumentsImages::where('file_type', DocumentsImages::FILE_IMAGE)->paginate(5);
        return view('customer.document_image.list_images', $data);
    }

    public function allDoc()
    {
        $data['title'] = "All Documents";
        $data['allDocs'] = DocumentsImages::where('file_type', DocumentsImages::FILE_DOC)->paginate(5);
        return view('customer.document_image.list_doc', $data);
    }

    public function showPreview(Request $request)
    {
        // open an image file
        $img = Image::make('images/' . '/' . $request->img);
        // now you are able to resize the instance
        $img->resize($request->w, 240);

        // finally you can return the image without saving it
        // create response and add encoded image data
        $response = Response::make($img->encode('png'));

        // set content-type
        $response->header('Content-Type', 'image/png');

        // output
        return $response;
    }

    public function deleteFile($id)
    {
        $deleteFile = DocumentsImages::find($id);
        if ($deleteFile->file_type == DocumentsImages::FILE_DOC) {

            $file_path = public_path('files') . '/' . $deleteFile->file_path;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        if ($deleteFile->file_type == DocumentsImages::FILE_IMAGE) {

            $file_path = public_path('images') . '/' . $deleteFile->file_path;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $deleteFile->delete();
        return redirect()->back();
    }
}
