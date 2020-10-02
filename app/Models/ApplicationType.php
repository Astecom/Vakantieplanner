<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApplicationType
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Application[] $applications
 *
 * @package App\Models
 */
class ApplicationType extends Model
{
	protected $table = 'application_types';

	protected $fillable = [
		'name'
	];

	public function applications()
	{
		return $this->hasMany(Application::class, 'type_id');
	}
}
