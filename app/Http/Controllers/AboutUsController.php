<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs; // Assuming you have an AboutUs model
use App\Models\OfficeContact;

use Illuminate\Support\Facades\Storage; // Import Storage facade for file handling
use Illuminate\Support\Facades\File;


class AboutUsController extends Controller
{
    //
    public function index()
    {
        $aboutUsContent = AboutUs::first();
        return view('admin.website_settings.index', compact('aboutUsContent'));
    }

    //     public function welcome()
    // {
    //     $aboutUsContent = AboutUs::first(); // Retrieve the first row from the "about_us" table
        
    //     return view('welcome', compact('aboutUsContent'));
    // }



    public function create()
    {
        return view('admin.website_settings.create');
    }

        

        public function store(Request $request)
{
    // Validate the form data
    $data = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for image upload
    ]);

    if ($request->hasFile('image_path')) {
        // Get the uploaded file
        $uploadedFile = $request->file('image_path');

        // Generate a unique filename
        $filename = time() . '_' . $uploadedFile->getClientOriginalName();

        // Specify the destination path within the 'public' folder
        $destinationPath = public_path('uploads'); // Change 'uploads' to your desired folder name

        // Move the file to the 'public' folder with the unique filename
        $uploadedFile->move($destinationPath, $filename);

        // Store the uploaded file in the 'storage/app/public/images' directory
        $imagePath = 'uploads/' . $filename; // Change 'uploads' to your desired folder name

        // Create a new AboutUs instance and store it in the database
        $aboutUs = new AboutUs([
            'title' => $data['title'],
            'description' => $data['description'],
            'image_path' => $imagePath,
        ]);

        $aboutUs->save();

        // Redirect back or to a success page
        return redirect()->route('admin.website_settings.index')->with('success', 'About Us content created successfully.');
    }

    // Handle the case where no file was uploaded
    return redirect()->route('admin.website_settings.create')->with('error', 'Image file is required.');
}


    public function edit(AboutUs $aboutUsContent)
    {
        return view('admin.website_settings.edit', compact('aboutUsContent'));
    }

    // public function update(Request $request, AboutUs $aboutUs)
    // {
    //     // Validate the form data
    //     $data = $request->validate([
    //         'title' => 'required|string',
    //         'description' => 'required|string',
    //         'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
    //     ]);
    
    //     // Initialize a variable for the updated image path
    //     $imagePath = $aboutUs->image_path;
    
    //     if ($request->hasFile('image_path')) {
    //         // Get the uploaded file
    //         $uploadedFile = $request->file('image_path');
    
    //         // Generate a unique filename
    //         $filename = time() . '_' . $uploadedFile->getClientOriginalName();
    
    //         // Specify the destination path within the 'public' folder
    //         $destinationPath = public_path('uploads'); // Change 'uploads' to your desired folder name
    
    //         // Move the file to the 'public' folder with the unique filename
    //         $uploadedFile->move($destinationPath, $filename);
    
    //         // Update the image path with the new path
    //         $imagePath = 'uploads/' . $filename; // Change 'uploads' to your desired folder name
    //     }
    
    //     // Update the AboutUs instance with the new data
    //     $aboutUs->update([
    //         'title' => $data['title'],
    //         'description' => $data['description'],
            
    //     ]);



    
    //     return redirect()->route('admin.website_settings.index')->with('success', 'About Us content updated successfully.');
    // }
    
    public function update(Request $request, AboutUs $aboutUs)
{
    // Validate the form data
    $data = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
    ]);

    // Initialize a variable for the updated image path
    $imagePath = $aboutUs->image_path;

    if ($request->hasFile('image_path')) {
        // Get the uploaded file
        $uploadedFile = $request->file('image_path');

        // Generate a unique filename
        $filename = time() . '_' . $uploadedFile->getClientOriginalName();

        // Specify the destination path within the 'public' folder
        $destinationPath = public_path('uploads'); // Change 'uploads' to your desired folder name

        // Move the file to the 'public' folder with the unique filename
        $uploadedFile->move($destinationPath, $filename);

        // Update the image path with the new path
        $imagePath = 'uploads/' . $filename; // Change 'uploads' to your desired folder name

        // Delete the old image file if it exists
        if ($aboutUs->image_path) {
            $oldImagePath = public_path($aboutUs->image_path);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
    }

    // Update the AboutUs instance with the new data
    $aboutUs->update([
        'title' => $data['title'],
        'description' => $data['description'],
        'image_path' => $imagePath,
    ]);

    return redirect()->route('admin.website_settings.index')->with('success', 'About Us content updated successfully.');
}
public function show(AboutUs $aboutUsContent)
{
    return view('admin.website_settings.show', compact('aboutUsContent'));
}




        public function destroy(AboutUs $aboutUs)
    {
        // Delete the associated image file
        $imagePath = public_path($aboutUs->image_path);
        
        // Check if the file exists before attempting to delete it
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Delete the AboutUs record from the database
        $aboutUs->delete();

        return redirect()->route('admin.website_settings.index')->with('delete', 'About Us content deleted successfully.');
    }

}
