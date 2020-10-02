<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Application
 *
 * @property int $id
 * @property int $type_id
 * @property int $status_id
 * @property int $user_id
 * @property string|null $remark
 * @property string|null $application_status_remark
 * @property string $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property ApplicationStatus $application_status
 * @property ApplicationType $application_type
 *
 * @package App\Models
 */
class Application extends Model
{
	protected $table = 'applications';

	protected $casts = [
		'type_id' => 'int',
		'status_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'type_id',
		'status_id',
		'user_id',
		'remark',
		'application_status_remark',
		'date'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function application_status()
	{
		return $this->belongsTo(ApplicationStatus::class, 'status_id');
	}

	public function application_type()
	{
		return $this->belongsTo(ApplicationType::class, 'type_id');
	}
}
