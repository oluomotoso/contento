<?php

namespace App\Http\Controllers\admin;

use App\datasource;
use App\datasource_feed;
use App\Jobs\FindFeeds;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('member.admin.default');
    }

    public function AddDatasourceView()
    {
        $sources = datasource::all();
        $feeds = datasource_feed::all();
        return view('member.admin.managesources', ['sources' => $sources, 'feeds' => $feeds]);
    }

    public function AddDatasource(Request $request)
    {
        $user = Auth::user();
        if (isset($_POST['add'])) {
            try {
                $setting = datasource::where('url', $request->url)->count();
                if ($setting > 0) {
                    $source = datasource::where('url', $request->url)->get();
                    $this->dispatch(new FindFeeds($request->url, $source[0]->id));
                } else {
                    $source = datasource::create([
                        'url' => $request->url,
                        'user_id' => $user->id
                    ]);
                    $this->dispatch(new FindFeeds($request->url, $source->id));

                }
                return redirect($request->path())->with('message', 'datasource saved successfully');
            } catch (\Exception $e) {
                return redirect($request->path())->withErrors($e->getMessage())->withInput();
            }
        } elseif (isset($_POST['manage_feeds'])) {
            $datas = datasource_feed::where('datasource_id', $request->datasource_id)->get();
            return view('member.admin.managefeeds', ['datas' => $datas]);
        } elseif (isset($_POST['toggle_feed_status'])) {
            if ($request->feed_status == 0) {
                datasource_feed::where('id', $request->feed_id)->update([
                    'status' => true
                ]);
            } elseif ($request->feed_status == 1) {
                datasource_feed::where('id', $request->feed_id)->update([
                    'status' => false
                ]);
            }
            $datas = datasource_feed::where('datasource_id', $request->datasource_id)->get();
            return view('member.admin.managefeeds', ['datas' => $datas]);
        }
    }

    public function ManageFeedsView()
    {
        $datas = datasource_feed::orderBy('name', 'asc')->get();
        return view('member.admin.managefeeds', ['datas' => $datas]);
    }


}
