<?php

namespace App\Services\Auth;

use App\Dtos\ApiResponse;
use App\Models\User;
use App\Repositories\EmailVerificationCodeRepository;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AuthService extends BaseService
{
    /**
     * @var EmailVerificationCodeRepository
     */
    private EmailVerificationCodeRepository $EmailVerificationCodeRepository;

    /**
     * @param UserRepository $repository
     * @param EmailVerificationCodeRepository $emailVerificationCodeRepository
     */
    public function __construct(UserRepository $repository, EmailVerificationCodeRepository $emailVerificationCodeRepository)
    {
        $this->repository = $repository;
        $this->EmailVerificationCodeRepository = $emailVerificationCodeRepository;
    }

    /**
     * @param array $data
     * @return JsonResponse
     * @throws Throwable
     */
    public function login(array $data): JsonResponse
    {
        /**
         * @var $model User
         */

        $model = $this->repository->findByEmailOrName($data['email']);

        if ($model and Hash::check($data['password'], $model->password))
        {
            return ApiResponse::success([
                'type' => 'Bearer',
                'token' => $this->repository->createToken($data['email']),
                'user' => $model,
            ]);
        } else {
            return ApiResponse::error("The provided username or password is incorrect.", Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * @param array $data
     * @return JsonResponse
     * @throws Throwable
     */
    public function register(array $data): JsonResponse
    {
        $EmailVerificationCodeRepository = $this->EmailVerificationCodeRepository->findByEmail($data['email']);

        if ($EmailVerificationCodeRepository and Hash::check($data['code'], $EmailVerificationCodeRepository->code))
        {
            $data['password'] = bcrypt($data['password']);
            $data['roles'] = [['role_code' => 'new_user', 'status' => true]];
            $data['email_verified_at'] = date('Y-m-d');
            $user = $this->repository->create($data);
            $EmailVerificationCodeRepository->delete($data['code']);

            return ApiResponse::success([
                'type' => 'Bearer',
                'token' => $this->repository->createToken($data['email']),
                'user' => $user,
            ]);

        } else {
            return ApiResponse::error("The email is not verified, please repeat again ", Response::HTTP_UNAUTHORIZED);
        }
    }


    /**
     * @param array $data
     * @return JsonResponse
     * @throws Throwable
     */
    public function resetPassword(array $data): JsonResponse
    {
        $emailVerification = $this->EmailVerificationCodeRepository->findByEmail($data['email']);

        if ($emailVerification and Hash::check($data['code'], $emailVerification->code))
        {

            $user = $this->repository->findByEmail($data['email']);
            $user->password = bcrypt($data['password']);
            $user->save();
            $emailVerification->delete();

            return ApiResponse::success([
                'type' => 'Bearer',
                'token' => $this->repository->createToken($data['email']),
                'user' => $user,
            ]);

        } else {
            return ApiResponse::error("The email is not verified , please repeat again ", Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * @return int
     * @throws Throwable
     */
    public function logout(): int
    {
        return $this->repository->removeToken(auth()->user());
    }
}
