<?php

namespace PS\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;



class CoreController extends Controller
{
    public function datatableLangAction(Request $request)
    {
        $currentLang='French.lang';
        
        $locale = $request->getLocale();
        if($locale == "en") {
            $currentLang='English.lang';
        }
        
        
        $rootDiri18nDataTable = $this->get('kernel')->getRootDir() . '/../web/assets/DataTables/Plugins-master/i18n/';
        $jsonLangFilepath = $rootDiri18nDataTable.$currentLang;
        $fileContentJsonWithComments  = file_get_contents($jsonLangFilepath);
        
        $pattern = '/\/\*\*(.|\n)*\*\//';
        $fileContentJson = preg_replace($pattern, '', $fileContentJsonWithComments);

        $response = new Response( $fileContentJson);


        return $response;

    }
    
}
