<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\ClassTransaction
 *
 * @property string $id
 * @property string $subject_id
 * @property string $classroom_id
 * @property string $semester_id
 * @property string $lecturer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClassTransactionDetail[] $classTransactionDetails
 * @property-read int|null $class_transaction_details_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClassTransactionStudent[] $classTransactionStudents
 * @property-read int|null $class_transaction_students_count
 * @property-read \App\Models\Classroom $classroom
 * @property-read \App\Models\User $lecturer
 * @property-read \App\Models\Semester $semester
 * @property-read \App\Models\Subject $subject
 * @method static \Database\Factories\ClassTransactionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransaction newQuery()
 * @method static \Illuminate\Database\Query\Builder|ClassTransaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransaction whereClassroomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransaction whereLecturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransaction whereSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransaction whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ClassTransaction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ClassTransaction withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperClassTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClassTransactionDetail
 *
 * @property string $id
 * @property string $class_transaction_id
 * @property string $shift_id
 * @property string $note
 * @property int $session
 * @property string|null $start_at
 * @property string|null $finish_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Shift $shift
 * @method static \Database\Factories\ClassTransactionDetailFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereClassTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereFinishAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereShiftId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperClassTransactionDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClassTransactionStudent
 *
 * @property string $id
 * @property string $class_transaction_id
 * @property string $student_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\User $student
 * @method static \Database\Factories\ClassTransactionStudentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionStudent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionStudent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionStudent query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionStudent whereClassTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionStudent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionStudent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionStudent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionStudent whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionStudent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperClassTransactionStudent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Classroom
 *
 * @property string $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classroom whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperClassroom extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Menu
 *
 * @property string $id
 * @property string $name
 * @property string $route_name
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereRouteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperMenu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Semester
 *
 * @property string $id
 * @property string $name
 * @property string|null $active_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester query()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereActiveAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperSemester extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Shift
 *
 * @property string $id
 * @property string $description
 * @property string $start_time
 * @property string $end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Shift newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shift newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shift query()
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shift whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperShift extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subject
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperSubject extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @mixin IdeHelperUser
 * @property string $id
 * @property string|null $semester_id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string $code
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Semester|null $semester
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class IdeHelperUser extends \Eloquent {}
}

