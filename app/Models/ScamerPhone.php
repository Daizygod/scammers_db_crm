<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ScamerPhone
 * 
 * @property int $id
 * @property int $scamer_id
 * @property string|null $phone
 * 
 * @property Scamer $scamer
 *
 * @package App\Models
 */
class ScamerPhone extends Model
{
	protected $table = 'scamer_phones';
	public $timestamps = false;

	protected $casts = [
		'scamer_id' => 'int'
	];

	protected $fillable = [
		'scamer_id',
		'phone'
	];

	public function scamer()
	{
		return $this->belongsTo(Scamer::class);
	}
}
