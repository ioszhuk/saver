<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App;

/**
 * Class Store
 *
 * @property integer $id
 * @property string $mime_type
 * @property string $url
 * @property string $path
 * @property integer $created_at
 * @property integer $updated_at
 */

class Store extends Model
{
	protected $table = 'store';

	protected $fillable = [
		'mime_type',
		'url',
		'path',
	];

	/**
	 * @return array
	 */
	public static function getMutatedModels()
	{
		$models = App\Store::all()->sortByDesc('id')->toArray();

		$mutatedModels = [];

		foreach($models as $model) {
			$model['file_name'] = App\Store::getFileNameByPath($model['path']);
			$mutatedModels[] = $model;
		}

		return $mutatedModels;
	}

	/**
	 * @param $path
	 *
	 * @return bool|null|string
	 */
	public static function getFileNameByPath($path)
	{
		if($path) {
			return substr($path, strrpos($path, '/') + 1);
		}
		return null;
	}

	/**
	 * @param $url
	 *
	 * @return array|bool
	 */
	public static function saveFile($url)
	{
		if($url) {
			try {

				if( ($file = file_get_contents($url)) ) {

					$fileName = Store::getFileNameByPath($url);

					Storage::disk('public')->put($fileName, $file);

					Store::create([
						'mime_type' => Storage::disk('public')->mimeType($fileName),
						'url' => $url,
						'path' => Storage::disk('public')->path($fileName),
					]);

					$store = Store::select('id', 'path')->get()->last()->toArray();

					$store['file_name'] = Store::getFileNameByPath($store['path']);

					return [
						'message' => "File: {$fileName} - uploaded successfully",
						'fileData' => $store,
					];
				}

			} catch(\Exception $e) {
				return false;
			}
		}

	}

	/**
	 * @param $id
	 *
	 * @return array|bool
	 */
	public static function removeFile($id)
	{
		if ( ($store = App\Store::find($id)) ) {

			$fileName = Store::getFileNameByPath($store->path);

			Storage::disk('public')->delete($fileName);

			$store->delete();

			return ['message' => "File: {$fileName} - removed"];
		} else {
			return false;
		}
	}

}
