<?php
namespace App\Repositories;

use App\Project;
use Image;

class ProjectsRepository{

   public function create($request)
   {
       $request->user()->projects()->create([
           'name'=>$request->name,
           'thumbnail'=>$this->thumb($request)
       ]);
   }

   #進行中プロジェクト
   public function todos($project)
   {
       return $project->tasks()->where('completion',0)->get();
   }

   #完成したプロジェクト
    public function dones($project)
    {
        return $project->tasks()->where('completion',1)->get();
    }

   public function list()
   {
       return request()->user()->projects()->get();
   }

   public function find($id)
   {
       return Project::findOrFail($id);
   }

   public function delete($id)
   {
       $project = $this->find($id);
       $project->delete();
   }

   public function update($request, $id)
   {
      $project = $this->find($id);
      $project->name = $request->name;
      if($request->hasFile('thumbnail')){
          $project->thumbnail = $this->thumb($request);
      }

      $project->save();

   }

    #ファイルアップロードのロジック
    public function thumb($request)
    {

        if($request->hasFile('thumbnail')){
            #アプロード元画像の保存処理
            $thumb = $request->thumbnail;
            $name = $thumb->hashName();
            $thumb->storeAs('public/thumbs/original',$name);


            #imageモジュールで画像編集
            #storageファイル内のpathを取得
//            $path = storage_path('app/public/thumbs/cropped/'.$name);
//            Image::make($thumb)->resize(200, 90)->save($path);
            return $name;
        }



        #条件判断方法
        //return $request->hasFile('thumbnail') ? $request->thumbnail->store('public/thumbs'):null;


#方法１
//        $path = null;
//        if($request->hasFile(thumbnail)){
//            $path = $request->thumbnail->store('public');
//        }
//        return $path;
#方法2
        #ファイルオブジェクトを取得
//        $thumb = $request->thumbnail;
        #        時間,      40桁のランダム文字列.拡張子
//        $name = date('Ymd').str_random(40).'.'.$thumb->extension();
//        $path = null;
        //アプロードされたのはファイルであるかどうか
//        if($request->hasFile('thumbnail')){
        //1.1
        //$path=$request->thumbnail->store('public/thumbs');
        //1.2
//            $path = $request->thumbnail->storeAs('public/thumbs',$name);
//        }
    }
}