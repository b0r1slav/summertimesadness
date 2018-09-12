<?php

namespace App\Module\Users\Http\Controllers\Admin;

use App\Mail\UserNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\User;
use Validator;


class UserController extends Controller
{
    protected $module = 'users';


    protected function updateRules()
    {
        return [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191',
            'password' => 'nullable|string|min:6|confirmed'
        ];
    }

    protected function storeRules()
    {
        return [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ];
    }

    protected function emailRules()
    {
        return [
            'subject' => 'required|string|min:3|max:191',
            'body' => 'required|string|min:10'
        ];
    }

    /**
     * Get a validator for an incoming request.
     *
     * @param  array $data
     * @param  array $rules
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, array $rules)
    {
        return Validator::make($data, $rules);
    }

    /**
     * Check if a user with the same eamil already
     * exist and redirect back with error if it is
     *
     * @param $email
     */
    protected function uniqueEmail($email)
    {
        $this->validator(
            ['email' => $email],
            ['email' => 'unique:users']
        )->validate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users::admin.index');
    }

    /**
     * Populate users grid
     *
     * @return mixed
     */
    public function data()
    {
        return DataTables::of(User::all())
            ->addColumn('action', function ($user) {

                return view('users::components.users-grid-action', ['user' => $user]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all(), $this->storeRules())->validate();

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('message', "User $newUser->name was successfully created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the send email form
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function showEmail(User $user)
    {
        return view('users::admin.email', compact('user'));
    }

    /**
     * Send email to a specified user
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail(Request $request, User $user)
    {
        $this->validator($request->all(), $this->emailRules())->validate();

        try {
            \Mail::to($user->email)->send(new UserNotification($request->all(), $user));

        } catch (\Exception $exception) {

            return redirect()->back()->with('exception', $exception->getMessage());
        }

        return redirect()->route('users.index')->with('message', 'Email was successfully sent.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users::admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        $this->validator($data, $this->updateRules())->validate();

        if ($request->email != $user->email) {
            $this->uniqueEmail($request->email);
        }

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update(array_filter($data));

        return redirect()->route('users.index')->with('message', 'The user was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
