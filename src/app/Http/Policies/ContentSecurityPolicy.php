<?php

namespace App\Http\Policies;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policies\Basic;

class ContentSecurityPolicy extends Basic
{
    public function configure()
    {
        parent::configure();

        $this
        ->addDirective(Directive::IMG, 'data:')
        ->addDirective(Directive::FONT, 'data:')
        // ->addDirective(Directive::FONT, 'fonts.bunny.net')
        ->addDirective(Directive::SCRIPT, 'fonts.bunny.net')
        ->addDirective(Directive::STYLE, 'fonts.bunny.net')
        ->addDirective(Directive::DEFAULT, 'fonts.bunny.net') //remove as this and above belongs for development template of welcome page
        ->addDirective(Directive::FONT, Keyword::SELF)
        ->addDirective(Directive::FONT, 'fonts.gstatic.com')
        ->addDirective(Directive::STYLE, 'fonts.googleapis.com');
    }
}

?>
