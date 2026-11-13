<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $member = $this->route('member');

        return [
            'member_code' => ['required', 'string', 'max:50', Rule::unique('members', 'member_code')->ignore($member)],
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['nullable', 'email', 'max:255', Rule::unique('members', 'email')->ignore($member)],
            'phone'       => ['nullable', 'string', 'max:20'],
            'address'     => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'member_code.required' => 'Kode anggota wajib diisi.',
            'member_code.unique'   => 'Kode anggota sudah dipakai.',
            'member_code.max'      => 'Kode anggota maksimal 50 karakter.',
            'name.required'        => 'Nama wajib diisi.',
            'name.max'             => 'Nama maksimal 255 karakter.',
            'email.email'          => 'Format email tidak valid.',
            'email.unique'         => 'Email sudah dipakai anggota lain.',
            'phone.max'            => 'Nomor telepon maksimal 20 karakter.',
        ];
    }
}