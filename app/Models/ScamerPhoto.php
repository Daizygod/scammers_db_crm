<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ScamerPhoto
 * 
 * @property int $id
 * @property int $scamer_id
 * @property string $photo_path
 * 
 * @property Scamer $scamer
 *
 * @package App\Models
 */
class ScamerPhoto extends Model
{
	protected $table = 'scamer_photos';
	public $timestamps = false;

	protected $casts = [
		'scamer_id' => 'int'
	];

	protected $fillable = [
		'scamer_id',
		'photo_path'
	];

	public function scamer()
	{
		return $this->belongsTo(Scamer::class);
	}
}
