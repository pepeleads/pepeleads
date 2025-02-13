<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import_questions(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx|max:20480',
        ]);

        // Store the uploaded file in the storage/app directory
        $path = $request->file('file')->store('uploads');
        // You can also get the full path using Storage facade
        $fullPath = storage_path('app/' . $path);
        // Load the Excel file
        $data = Excel::toArray([], $fullPath);

        // Access the data
        $sheetData = $data[0];
        $full_array=[];

        if(isset($sheetData) && count($sheetData) > 0){
            for($i=0; $i<count($sheetData); $i++){
                if($i>0){
                    $getGadget = Gadget::where('name',$sheetData[$i][1])->first();
                    $getBrand = Brand::where('name',$sheetData[$i][0])->first();
                    // dd($getBrand, $getGadget);
                    if($getGadget && $getBrand){
                        $cat=$sheetData[$i][9];

                        if($cat=='default'){
                            $full_array[]= [
                                'gadget_type' => $getGadget->id,
                                'brand' => $getBrand->id,
                                'question' => $sheetData[$i][2],
                                'option' => $sheetData[$i][3],
                                'option_number' => $sheetData[$i][4],
                                'continue_or_terminate' => $sheetData[$i][5],
                                'add_or_subtract' => $sheetData[$i][6],
                                'percent_or_fix' => $sheetData[$i][7],
                                'rate' => $sheetData[$i][8]
                               ];
                        }else{
                            $get_cat=QuestionCategory::where('category_name',$cat)->where('device_id',$getBrand->id)->first();

                            if($get_cat){
                                $full_array[]= [
                                 'gadget_type' => $getGadget->id,
                                 'brand' => $getBrand->id,
                                 'question' => $sheetData[$i][2],
                                 'option' => $sheetData[$i][3],
                                 'option_number' => $sheetData[$i][4],
                                 'continue_or_terminate' => $sheetData[$i][5],
                                 'add_or_subtract' => $sheetData[$i][6],
                                 'percent_or_fix' => $sheetData[$i][7],
                                 'rate' => $sheetData[$i][8],
                                 'category_id' => $get_cat->id
                                ];
                            }else{
                                $create_cat=QuestionCategory::create([
                                    'category_name'=>$cat,
                                    'category_title'=>$cat,
                                    'category_description'=>$cat,
                                    'device_id'=>$getBrand->id
                                ]);

                                $full_array[]= [
                                    'gadget_type' => $getGadget->id,
                                    'brand' => $getBrand->id,
                                    'question' => $sheetData[$i][2],
                                    'option' => $sheetData[$i][3],
                                    'option_number' => $sheetData[$i][4],
                                    'continue_or_terminate' => $sheetData[$i][5],
                                    'add_or_subtract' => $sheetData[$i][6],
                                    'percent_or_fix' => $sheetData[$i][7],
                                    'rate' => $sheetData[$i][8],
                                    'category_id' => $create_cat->id
                                   ];
                            }
                        }
                    }
                }
            }
        }

        foreach($full_array as $item){
          
                $add_question=Question::updateOrCreate([
                    'question'=>$item['question'],
                    'device_id'=>$item['gadget_type'],
                    'brand_id'=>$item['brand'],
                ],[
                    'question'=>$item['question'],
                    'device_id'=>$item['gadget_type'],
                    'brand_id'=>$item['brand'],
                    'category_id'=>isset($item['category_id'])?$item['category_id']: "0"
                ]);
        
                Option::create([
                    'question_id'=>$add_question->id,
                    'option_number'=>$item['option_number'],
                    'option'=>$item['option'],
                    'sign'=>($item['add_or_subtract']=='add'?1:0),
                    'rate_type'=>($item['percent_or_fix']=='percent')?1:0, // 1 for percent and 0 for fixed rate
                    'rate'=>$item['rate'],
                    'continue'=>($item['continue_or_terminate']=='continue'?1:0)
                ]);
        }

        return redirect('/admin/add_question')->with('success', 'Data imported successfully.');
    }
}
