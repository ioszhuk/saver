<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$models = App\Store::getMutatedModels();

		return view('store.index', ['models' => $models]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if($request->ajax()) {

			$validator = \Validator::make($request->all(), [
				'url' => 'required|max:255',
			]);

			if ($validator->fails()) {
				return response()->json($validator->errors()->all(), 422);
			}

			if( ($response = App\Store::saveFile($request->url)) ) {
				$response['fileData'] = $this->renderHtml($response['fileData']);
				return response()->json($response, 200);
			} else {
				return response()->json(['message' => 'Error in file uploading process.'], 500);
			}

		}

	}

	/**
	 * Download file
	 *
	 * @param $id
	 *
	 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
	 */
	public function download($id)
	{
		if( ($file = App\Store::find($id)) ) {
			return response()->download($file->path);
		}
		return redirect('/');
	}

	/**
	 * Delete file
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Request $request) {

		if ( $request->ajax() ) {

			if( ($response = App\Store::removeFile($request->id)) ) {
				return response()->json($response, 200 );
			} else {
				return response()->json(['message' => 'Error in file removing process.'], 500);
			}

		}

	}

	/**
	 * Render row html
	 *
	 * @param $store
	 *
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Throwable
	 */
	protected function renderHtml($store)
	{
		$html = view('store.components.row', ['model' => $store])->render();
		return response()->json(['html' => $html]);
	}
}
