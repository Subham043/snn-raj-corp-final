<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('email.mailer', 'smtp');
        $this->migrator->add('email.host', 'mail.5ine.in');
        $this->migrator->add('email.port', 587);
        $this->migrator->add('email.username', 'test5ine@5ine.in');
        $this->migrator->add('email.password', '5ine123#@!');
        $this->migrator->add('email.encryption', 'tls');
        $this->migrator->add('email.from_address', 'testing@5ines.com');
        $this->migrator->add('email.from_name', 'SNN RAJ CORP');
    }
};
