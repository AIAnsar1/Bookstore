<?php

namespace App\Services;

use App\Dtos\ApiResponse;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as Status;
use App\Repositories\EmailVerificationCodeRepository;

class AuthorService extends BaseService
{
    private EmailVerificationCodeRepository $EmailVerificationCodeRepository;
    public function __construct(UserRepository $repository, EmailVerificationCodeRepository $EmailVerificationCodeRepository)
    {
        $this->repository = $repository;
        $this->EmailVerificationCodeRepository = $EmailVerificationCodeRepository;
    }


    public function login($data): JsonResponse
    {
        $model = $this->repository->findByEmailOrName($data['email']);

        if ($model and Hash::check($data['password'], $model->password))
        {
            return ApiResponse::success([
                'type' => 'Bearer',
                'token' => $this->repository->createToken($data['email']),
                'user' => $model,
            ]);
        }else{
            return ApiResponse::error("Email or Password incorrect", Response::HTTP_UNAUTHORIZED);
        }

    }

    public function register(array $data): JsonResponse
    {
        $emailVerification = $this->EmailVerificationCodeRepository->findByEmail($data['email']);

        if ($emailVerification and Hash::check($data['code'], $emailVerification->code))
        {
            $data['password'] = bcrypt($data['password']);
            $data['roles'] = [['role_code' => 'new_user', 'status' => true]];
            $data['email_verified_at'] = date('Y-m-d');
            $user = $this->repository->create($data);
            $emailVerification->delete();

            return ApiResponse::success([
                'type' => 'Bearer',
                'token' => $this->repository->createToken($data['email']),
                'user' => $user,
            ]);
        }else {
            return ApiResponse::error("The Email is not verified, please repeat again", Response::HTTP_UNAUTHORIZED);
        }
    }

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
        }else{
            return ApiResponse::error("The Email is not verified, please repeat again", Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(): mixed
    {
        $user = auth()->user();

        if ($user)
        {
            return $this->repository->removeToken($user);
        }

        return redirect()->route('login');
    }
}
