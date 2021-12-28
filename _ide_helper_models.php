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
 * App\Models\Assignment
 *
 * @property string $id
 * @property string $user_id
 * @property string $class_transaction_id
 * @property string $title
 * @property string $attachment
 * @property string $start_at
 * @property string $end_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AssignmentSubmission[] $assignmentSubmission
 * @property-read int|null $assignment_submission_count
 * @property-read \App\Models\ClassTransaction $classTransaction
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\AssignmentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereClassTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperAssignment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AssignmentSubmission
 *
 * @property string $id
 * @property string $assignment_id
 * @property string $user_id
 * @property string $attachment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\AssignmentSubmissionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereAssignmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssignmentSubmission whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperAssignmentSubmission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClassTransaction
 *
 * @mixin IdeHelperClassTransaction
 * @property string $id
 * @property string $subject_id
 * @property string $classroom_id
 * @property string $semester_id
 * @property string $lecturer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Assignment[] $assignment
 * @property-read int|null $assignment_count
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
 */
	class IdeHelperClassTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClassTransactionDetail
 *
 * @mixin IdeHelperClassTransactionDetail
 * @property string $id
 * @property string $class_transaction_id
 * @property string $shift_id
 * @property string $note
 * @property int $session
 * @property \Illuminate\Support\Carbon $transaction_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\ClassTransaction $classTransaction
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ForumThread[] $forumThreads
 * @property-read int|null $forum_threads_count
 * @property-read \App\Models\Shift $shift
 * @method static \Database\Factories\ClassTransactionDetailFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereClassTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereShiftId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereTransactionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClassTransactionDetail whereUpdatedAt($value)
 */
	class IdeHelperClassTransactionDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClassTransactionStudent
 *
 * @mixin IdeHelperClassTransactionStudent
 * @property string $id
 * @property string $class_transaction_id
 * @property string $student_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\ClassTransaction $classTransaction
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
 */
	class IdeHelperClassTransactionStudent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Classroom
 *
 * @mixin IdeHelperClassroom
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
 */
	class IdeHelperClassroom extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ForumReply
 *
 * @property string $id
 * @property string $forum_thread_id
 * @property string $user_id
 * @property string|null $forum_reply_id
 * @property string $content
 * @property string|null $attachment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ForumReplyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply whereForumReplyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply whereForumThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumReply whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperForumReply extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ForumThread
 *
 * @property string $id
 * @property string $user_id
 * @property string $class_transaction_detail_id
 * @property string $title
 * @property string $content
 * @property string|null $attachment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ClassTransactionDetail $classTransactionDetail
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ForumReply[] $forumReplies
 * @property-read int|null $forum_replies_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ForumThreadFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumThread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumThread newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumThread query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForumThread whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumThread whereClassTransactionDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumThread whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumThread whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumThread whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumThread whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumThread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForumThread whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperForumThread extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Menu
 *
 * @mixin IdeHelperMenu
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
 */
	class IdeHelperMenu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Semester
 *
 * @mixin IdeHelperSemester
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
 */
	class IdeHelperSemester extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Shift
 *
 * @mixin IdeHelperShift
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
 */
	class IdeHelperShift extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subject
 *
 * @mixin IdeHelperSubject
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClassTransactionStudent[] $classTransactionStudents
 * @property-read int|null $class_transaction_students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClassTransaction[] $classTransactions
 * @property-read int|null $class_transactions_count
 * @property-read mixed $active_semester
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

