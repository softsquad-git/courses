<?php

namespace App\Services\Users;

use App\Interfaces\Mailer;
use App\Jobs\SendEmail;
use App\Models\Users\User;
use App\Services\Service;
use App\Traits\VerificationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Exception;
use JetBrains\PhpStorm\Pure;

class RegisterService extends Service
{
    use VerificationTrait;

    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @param User $model
     */
    #[Pure] public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function save(array $data): Model
    {
        $data['password'] = Hash::make($data['password']);

        DB::beginTransaction();
        try {
            $user = parent::save($data);

            $token = $this->generateToken(15);
            $this->saveToken($token, $user->email);

//            SendEmail::dispatch([
//                'to' => $user->email,
//                'from' => config('mail.from.address'),
//                'template' => 'registers.verification',
//                'body' => [
//                    'user' => $user,
//                    'token' => $token
//                ],
//                'subject' => __('mail.subjects.register.verify')
//            ])->afterCommit();

            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
