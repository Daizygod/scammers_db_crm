<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ScamerPass
 * 
 * @property int $id
 * @property int $scamer_id
 * @property string|null $pass_serial
 * @property string|null $pass_number
 * @property string|null $photo_path
 * @property bool|null $is_real
 * 
 * @property Scamer $scamer
 *
 * @package App\Models
 */
class ScamerPass extends Model
{
	protected $table = 'scamer_passes';
	public $timestamps = false;

	protected $casts = [
		'scamer_id' => 'int',
		'is_real' => 'bool'
	];

	protected $fillable = [
		'scamer_id',
		'pass_serial',
		'pass_number',
		'photo_path',
		'is_real'
	];

	public function scamer()
	{
		return $this->belongsTo(Scamer::class);
	}
}
