<?php

namespace app\components;

use DOMDocument;
use DOMXPath;

class WikiParser {
    /*
     * $wikiUrl contains link to the wikipedia article
     */
    public function WikiParse($wikiUrl)
    {
        $wikiData = explode('/wiki/', $wikiUrl);

        $wikiData[0] = str_replace( 'http://', '', $wikiData[0] );
        $wikiData[0] = str_replace( 'https://', '', $wikiData[0] );

        $dataLang = explode( '.', $wikiData[0] );
        $baseUrl = 'http://' . $dataLang[0] . '.wikipedia.org/w/api.php?action=parse&page=' . $wikiData[1] . '&format=json&prop=text&section=0';

        $parseData = file_get_contents( $baseUrl );
        $json = json_decode( $parseData );

        if ( !isset( $json->error ) ) {
            $section = $json->{'parse'}->{'text'}->{'*'};

            //Take main image
            preg_match_all('/\<img.*\>/', $section, $images);
            $images = preg_replace('"<img alt=\"\"[^>]*?></div>"', '', $images[0]);
            $image = array_filter($images);
            $image = reset($image);

            //Take title
            $title = $json->parse->title;

            //Parse html and delete unnecessary information from imported text
            $dom = new DOMDocument;
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($section, 'HTML-ENTITIES', 'UTF-8'));
            libxml_clear_errors();
            $xpath = new DOMXPath($dom);
            $htmlDivs = [".//div[@class='hatnote']",
                ".//ol[@class='references']",
                ".//div[@id='toc']",
                ".//table[contains(concat(' ', @class, ' '), ' infobox ')]",
                ".//table[contains(concat(' ', @class, ' '), ' plainlinks ')]",
                ".//div[@role='note']",
                ".//div[@class='thumb tright']"];
            foreach ($htmlDivs as $div) {
                $expressions = $xpath->query($div);
                foreach ($expressions as $expression) {
                    $expression->parentNode->removeChild($expression);
                }
            }
            $text = $dom->saveHTML();

            //FRONT-END developer can modify styles for parsed text here!
            $data = $image;
            $data .= "<h2>$title</h2>";
            // here you can "clean" text
            $data .= $text;
        } else {
            var_dump( $json->error );
            exit;
        }

        //Truncate article for better view on Attraction page (also it saves free space in DB)
        $data = mb_substr($data,0,mb_strrpos(mb_substr($data,0,2200,'utf-8'),' ','utf-8'),'utf-8') . '...';
        return $data;
    }
}
