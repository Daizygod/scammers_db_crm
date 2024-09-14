<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Enums\ProfileTypeEmun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * Class ScamerProfile
 * 
 * @property int $id
 * @property int $scamer_id
 * @property string $type
 * @property string $url
 * 
 * @property Scamer $scamer
 *
 * @package App\Models
 */
class ScamerProfile extends Model
{
	protected $table = 'scamer_profiles';
	public $timestamps = false;

	protected $casts = [
		'scamer_id' => 'int'
	];

	protected $fillable = [
		'scamer_id',
		'type',
		'url'
	];

	public function scamer()
	{
		return $this->belongsTo(Scamer::class);
	}

//    public static function boot()
//    {
//        parent::boot();
//
//        self::created(function($model){
//            if ($model->type === ProfileTypeEmun::AVITO) {
//                $model->url = parse_url($model->url, PHP_URL_SCHEME)
//                    . '://'
//                    . parse_url($model->url, PHP_URL_HOST)
//                    . parse_url($model->url, PHP_URL_PATH);
//                Log::info("before " . $model->url);
//                Log::info("after " . $model->url);
//                $model->save();
//            }
//        });
//    }

}
