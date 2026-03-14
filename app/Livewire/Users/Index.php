<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

#[Layout('layouts.app')]
#[Title('Usuarios')]
class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $search = '';

    public bool $showModal = false;
    public ?int $editingId = null;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public ?int $role_id = null;
    public bool $is_active = true;

    public function mount(): void
    {
        if (! Auth::check()) {
            $this->redirect(route('login'), navigate: true);
            return;
        }

        abort_unless(Auth::user()?->isAdmin(), 403);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->editingId),
            ],
            'role_id' => ['required', 'exists:roles,id'],
            'is_active' => ['boolean'],
            'password' => $this->editingId
                ? ['nullable', 'string', 'min:8', 'same:password_confirmation']
                : ['required', 'string', 'min:8', 'same:password_confirmation'],
            'password_confirmation' => $this->editingId
                ? ['nullable', 'string', 'min:8']
                : ['required', 'string', 'min:8'],
        ];
    }

    protected array $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El correo es obligatorio.',
        'email.email' => 'Ingresa un correo válido.',
        'email.unique' => 'Ese correo ya está registrado.',
        'role_id.required' => 'Selecciona un rol.',
        'role_id.exists' => 'El rol seleccionado no es válido.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.same' => 'La confirmación de contraseña no coincide.',
        'password_confirmation.required' => 'Confirma la contraseña.',
    ];

    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->resetValidation();
        $this->showModal = true;
    }

    public function openEditModal(int $userId): void
    {
        $user = User::findOrFail($userId);

        $this->editingId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->role_id = $user->role_id;
        $this->is_active = (bool) $user->is_active;
        $this->showModal = true;

        $this->resetValidation();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetValidation();
        $this->resetForm();
    }

    protected function resetForm(): void
    {
        $this->editingId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role_id = null;
        $this->is_active = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => (int) $validated['role_id'],
            'is_active' => (bool) $validated['is_active'],
        ];

        if (! empty($validated['password'])) {
            $data['password'] = $validated['password'];
        }

        if ($this->editingId) {
            $user = User::findOrFail($this->editingId);
            $user->update($data);

            $this->closeModal();

            $this->dispatch(
                'swal',
                title: 'Usuario actualizado',
                text: 'Los cambios se guardaron correctamente.',
                icon: 'success'
            );

            return;
        }

        User::create($data);

        $this->closeModal();

        $this->dispatch(
            'swal',
            title: 'Usuario creado',
            text: 'El usuario se guardó correctamente.',
            icon: 'success'
        );
    }

    public function toggleStatus(int $userId): void
    {
        $user = User::findOrFail($userId);

        $user->update([
            'is_active' => ! $user->is_active,
        ]);

        $this->dispatch(
            'swal',
            title: $user->is_active ? 'Usuario activado' : 'Usuario desactivado',
            text: $user->is_active
                ? 'El usuario quedó activo nuevamente.'
                : 'El usuario fue desactivado correctamente.',
            icon: 'success'
        );
    }

    public function deleteUser(int $userId): void
    {
        $user = User::findOrFail($userId);

        if ((int) $user->id === (int) Auth::id()) {
            $this->dispatch(
                'swal',
                title: 'Acción no permitida',
                text: 'No puedes eliminar tu propio usuario mientras tienes la sesión iniciada.',
                icon: 'warning'
            );

            return;
        }

        try {
            $user->delete();

            if ($this->editingId === $userId) {
                $this->closeModal();
            }

            $this->dispatch(
                'swal',
                title: 'Usuario eliminado',
                text: 'El usuario se eliminó correctamente.',
                icon: 'success'
            );

            $this->resetPage();
        } catch (Throwable $e) {
            $this->dispatch(
                'swal',
                title: 'No se pudo eliminar',
                text: 'El usuario tiene información relacionada o ocurrió un error al intentar eliminarlo.',
                icon: 'error'
            );
        }
    }

    public function render()
    {
        $roles = Role::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $users = User::query()
            ->with('role')
            ->when(trim($this->search) !== '', function ($query) {
                $term = trim($this->search);

                $query->where(function ($subQuery) use ($term) {
                    $subQuery->where('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%")
                        ->orWhereHas('role', function ($roleQuery) use ($term) {
                            $roleQuery->where('name', 'like', "%{$term}%");
                        });
                });
            })
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.users.index', [
            'roles' => $roles,
            'users' => $users,
        ]);
    }
}
