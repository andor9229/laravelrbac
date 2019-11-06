<?php

namespace Andor9229\Rbac;

use Andor9229\Rbac\View\Create;
use Andor9229\Rbac\View\Edit;
use Andor9229\Rbac\View\Index;
use Andor9229\Rbac\View\Layouts\Layout;
use Andor9229\Rbac\View\ManageUsers;
use Andor9229\Rbac\View\Trash;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InstallRbac extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rbac:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install RBAC';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->user();
    }

    private function user()
    {
        $this->createDirs();
        $this->makeAuth();
        $this->layout('app');
        $this->request('user');
        $this->request('role');
        $this->request('permission');
        $this->request('account');
        $this->model('user');
        $this->model('role');
        $this->model('permission');
        $this->controller('user');
        $this->controller('role');
        $this->controller('permission');
        $this->controller('account');
        $this->views('index');
        $this->views('user');
        $this->views('role');
        $this->views('permission');
        $this->views('permission');
        $this->views('account');
        $this->migration('user');
        $this->migration('role');
        $this->migration('permission');
        $this->migration('role_user');
        $this->migration('permission_role');
        $this->command();
        $this->route('rbac');
        $this->route('web');
        $this->migrate();
        $this->middleware('ChangePassword');
        $this->config('chameleon');
    }

    private function makeAuth()
    {
        $this->call('make:auth');
    }

    private function layout($name)
    {
        $layout = new Layout($name);
        $layout->setTemplate();
        $layout->filePutContests('resource');
    }

    private function createDirs()
    {
        $this->line('Creo le cartelle...');
        try {
            File::makeDirectory(app_path('Console/Commands'), $mode = 0777, true, true);
            File::makeDirectory(app_path('Models/Rbac/User'), $mode = 0777, true, true);
            File::makeDirectory(app_path('Models/Rbac/Role'), $mode = 0777, true, true);
            File::makeDirectory(app_path('Models/Rbac/Permission'), $mode = 0777, true, true);
            File::makeDirectory(app_path('Http/Controllers/Rbac'), $mode = 0777, true, true);
            File::makeDirectory(app_path('Http/Requests/User'), $mode = 0777, true, true);
            File::makeDirectory(app_path('Http/Requests/Role'), $mode = 0777, true, true);
            File::makeDirectory(app_path('Http/Requests/Permission'), $mode = 0777, true, true);
            File::makeDirectory(app_path('Http/Requests/Account'), $mode = 0777, true, true);
            File::makeDirectory(resource_path('views/layouts'), $mode = 0777, true, true);
            File::makeDirectory(resource_path('views/pages/rbac/user'), $mode = 0777, true, true);
            File::makeDirectory(resource_path('views/pages/rbac/role'), $mode = 0777, true, true);
            File::makeDirectory(resource_path('views/pages/rbac/permission'), $mode = 0777, true, true);
            File::makeDirectory(resource_path('views/pages/rbac/account'), $mode = 0777, true, true);

            $this->info('Cartelle create correttamente!');
        } catch (\Exception $e) {
            $this->error('Qualcosa è andato storto!');
        }

    }

    private function request($name)
    {
        $request = new Request($name);
        $request->setTemplate();
        $request->filePutContests();
    }

    private function model($name)
    {
        $this->line("Creazione modello " . Str::ucfirst($name) . "...");
        try {
            $model = new Model($name);
            $model->setTemplate();
            $model->filePutContests();
            $this->info("Modello " . Str::ucfirst($name) . " Creato!");
        } catch (\Exception $e) {
            dd($e->getMessage());
            $this->error('Qualcosa è andato storto!');
        }

    }

    private function controller($name)
    {
        $controller = new Controller($name);
        $controller->setTemplate();
        $controller->filePutContests();
    }

    private function views($name)
    {
        if($name === 'index') {
            $index = new ManageUsers();
            $index->setTemplate();
            $index->filePutContests('resource');
            return;
        }
        if($name === 'permission' || $name === 'account') {
            $index = $index = new Index($name);
            $index->setTemplate();
            $index->filePutContests('resource');
            return;
        }

        $index = new Index($name);
        $edit = new Edit($name);
        $create = new Create($name);
        $trash = new Trash($name);

        $index->setTemplate();
        $edit->setTemplate();
        $create->setTemplate();
        $trash->setTemplate();

        $index->filePutContests('resource');
        $edit->filePutContests('resource');
        $create->filePutContests('resource');
        $trash->filePutContests('resource');
    }

    private function migration($name)
    {
        $migration = new Migration($name);
        $migration->setTemplate();
        $migration->filePutContests('database');
    }

    private function command()
    {
        $command = new \Andor9229\Rbac\Command();
        $command->setTemplate();
        $command->filePutContests();
    }

    private function route($name)
    {
        $route = new Route($name);
        $route->setTemplate();
        $route->filePutContests('routes');
    }

    private function migrate()
    {
        $this->call('migrate');
    }

    private function middleware($name)
    {
        $changePassword = new Middleware($name);
        $changePassword->create();
        $changePassword->setTemplate();
        $changePassword->filePutContests();
        $changePassword->updateKernel();
    }

    private function config($name)
    {
        $changePassword = new Config($name);
        $changePassword->setTemplate();
        $changePassword->filePutContests('config');
    }
}
