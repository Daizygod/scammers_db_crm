<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ScamPhoto
 * 
 * @property int $id
 * @property int $scam_operation_id
 * @property string $photo_path
 * 
 * @property ScamerScamOperation $scamer_scam_operation
 *
 * @package App\Models
 */
class ScamPhoto extends Model
{
	protected $table = 'scam_photo';
	public $timestamps = false;

	protected $casts = [
		'scam_operation_id' => 'int'
	];

	protected $fillable = [
		'scam_operation_id',
		'photo_path'
	];

	public function scamer_scam_operation()
	{
		return $this->belongsTo(ScamerScamOperation::class, 'scam_operation_id');
	}
}
