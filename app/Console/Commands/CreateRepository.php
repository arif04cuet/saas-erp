<?php

namespace App\Console\Commands;

use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Support\Stub;
use Nwidart\Modules\Traits\ModuleCommandTrait;


class CreateRepository extends GeneratorCommand
{

    use ModuleCommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-repository {name : Name of the repository} {module : Name of the module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Repository class for a module';

    /**
     * The type of class being generated.
     * This only used for console output
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Get the destination file path.
     *
     * @return string
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $repositoryPath = $this->getRepositoryPath();

        return $path . $repositoryPath . $this->getRepositoryName() . '.php';
    }


    /**
     * @return array|string
     */
    protected function getRepositoryName()
    {
        $repository = studly_case($this->argument('name'));

        if (str_contains(strtolower($repository), 'repository') === false) {
            $repository .= 'Repository';
        }

        return $repository;
    }

    /**
     * Return the folder name of service classes
     * @return string
     */
    private function getRepositoryPath(): string
    {
        return 'Repositories/';
    }

    /**
     * Get stub path.
     * @return string
     */
    public function getStudPath()
    {
        return __DIR__ . '/Stubs/repository.stub';
    }

    /**
     * Get template contents.
     * @return string
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());
        return $this->getContents([
            'DummyClass' => $this->getRepositoryName(),
            'DummyNamespace' => $this->getClassNamespace($module),
        ]);
    }

    /**
     * Get stub contents.
     * @return mixed|string
     */
    public function getContents(array $replaces)
    {
        $contents = file_get_contents($this->getStudPath());
        foreach ($replaces as $search => $replace) {
            $contents = str_replace($search, $replace, $contents);
        }
        return $contents;
    }

    /**
     * Return the nameSpace of the class
     * @param \Nwidart\Modules\Module $module
     * @return string
     */
    public function getClassNamespace($module): string
    {
        return 'Modules\\' . $module . '\Repositories';
    }


}
