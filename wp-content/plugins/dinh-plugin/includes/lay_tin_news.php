<?php

include_once("html/simple_html_dom.php");
global $wpdb;
$prefix = $wpdb->prefix;
$table_danhmuc = $prefix . 'tintuc_danhmuc';
$table_bai_viet = $prefix . 'tintuc_baiviet';

class Lay_Tin_News
{
    private $thml;

    function __construct($link)
    {
        $this->html = file_get_html($link);
    }
    function layTinHomepage()
    {
        $get_danh_muc = $this->html->getTitle_link('ul.nav li a');
        return $get_danh_muc;

    }
    // function lay title cua bai viet
    function getTitle_link($elements, $sl = null)
    {
        $chuyen_muc[] = '';
        $i = 0;
        foreach ($this->html->find($elements, $sl) as $element) {
            $chuyen_muc[$i]['title'] = $element->title;
            $chuyen_muc[$i]['link'] = $element->href;
            $chuyen_muc[$i]['content'] = $element->outertext;
            $i++;
        }
        return $chuyen_muc;
    }

    function getImage_url($elements, $sl = null)
    {
        $chuyen_muc[] = '';
        $i = 0;
        foreach ($this->html->find($elements, $sl) as $element) {
            $chuyen_muc[$i] = $element->src;
            $i++;
        }
        return $chuyen_muc;
    }

    public function removeNode($selector)
    {
        foreach ($this->html->find($selector) as $node) {
            $node->outertext = '';
        }

        $this->html->load($this->html->save());
    }

    public function getDanhmuc()
    {
        $link = 'http://dantri.com.vn';
        $this->html = new Lay_Tin($link);
// Find all links
        global $wpdb;
        $prefix = $wpdb->prefix;
        $table = $prefix . 'tintuc_danhmuc';
        $danh_muc = $wpdb->get_results('SELECT * FROM ' . $table);
        $get_danh_muc = $this->html->getTitle_link('ul.nav li a');
        if ($danh_muc) {
            foreach ($get_danh_muc as $value) {
                $check = $wpdb->get_row("SELECT * FROM " . $table . " WHERE link_danh_muc = '" . $link . $value['link'] . "'", OBJECT);
                if (!$check) {
                    $data = [
                        'ten_danh_muc' => $value['title'],
                        'link_danh_muc' => $link . $value['link']
                    ];
                    $format = array('%s', '%s');
                    $wpdb->insert($table, $data, $format);
                }
            }
        } else {
            foreach ($get_danh_muc as $value) {
                $data = [
                    'ten_danh_muc' => $value['title'],
                    'link_danh_muc' => $link . $value['link']
                ];
                $format = array('%s', '%s');
                $wpdb->insert($table, $data, $format);
            }
        }
    }

    public function getTin()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $table_danhmuc = $prefix . 'tintuc_danhmuc';
        $table_bai_viet = $prefix . 'tintuc_baiviet';
        $bai_viet = $wpdb->get_results('SELECT * FROM ' . $table_bai_viet);
        $danh_muc = $wpdb->get_results('SELECT * FROM ' . $table_danhmuc);
        foreach ($danh_muc as $danhmuc) {
            $link = 'http://dantri.com.vn';
            $link_danh_muc = $danhmuc->link_danh_muc;
            $this->html = new Lay_Tin($link_danh_muc);
            $get_bai_viet = $this->html->getTitle_link('div.mt3 .mr1 h2 a');
            $get_image_bai_viet = $this->html->getImage_url('div.mt3 img');
            $remove_link_mota = $this->html->removeNode('div.fon5 a');
            $get_mota = $this->html->getTitle_link('div.fon5');
            //dd($get_mota);
            if ($bai_viet) {
                $coun_bai_viet = 0;
                foreach ($get_bai_viet as $baiviet) {
                    $check = $wpdb->get_row("SELECT * FROM " . $table_bai_viet . " WHERE link_bai_viet = '" . $link . $baiviet['link'] . "'", OBJECT);
                    if (!$check) {
                        $data = [
                            'id_danh_muc' => $danhmuc->id,
                            'ten_bai_viet' => $baiviet['title'],
                            'link_bai_viet' => $link . $baiviet['link'],
                            'mo_ta' => $get_mota[$coun_bai_viet]['content'],
                            'image' => $get_image_bai_viet[$coun_bai_viet]
                        ];
                        $format = array('%s', '%s', '%s', '%s', '%s');
                        $wpdb->insert($table_bai_viet, $data, $format);
                    }
                    $coun_bai_viet++;

                }
            } else {
                $coun_bai_viet = 0;
                foreach ($get_bai_viet as $baiviet) {
                    $data = [
                        'id_danh_muc' => $danhmuc->id,
                        'ten_bai_viet' => $baiviet['title'],
                        'link_bai_viet' => $link . $baiviet['link'],
                        'mo_ta' => $get_mota[$coun_bai_viet]['content'],
                        'image' => $get_image_bai_viet[$coun_bai_viet]
                    ];
                    $format = array('%s', '%s', '%s', '%s', '%s');
                    $wpdb->insert($table_bai_viet, $data, $format);
                    $coun_bai_viet++;
                }

                // dd($get_bai_viet);
            }

        }
    }

    /**
     * @return bool|simple_html_dom
     */
    public function getChitiettin()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $table_bai_viet = $prefix . 'tintuc_baiviet';
        $bai_viet = $wpdb->get_results('SELECT * FROM ' . $table_bai_viet);
        foreach ($bai_viet as $baiviet) {

            if (empty($bai_viet->chi_tiet_bai_viet)) {
                $link = 'http://dantri.com.vn';
                $link_bai_viet = $baiviet->link_bai_viet;
                $this->html = new Lay_Tin($link_bai_viet);
                $remove_tag = $this->html->removeNode('.news-tag-list');
                $remove_author = $this->html->removeNode('p[style=text-align: right;]');
                $get_noi_dung_bai_viet = $this->html->getTitle_link('div#divNewsContent');
                //dd($get_noi_dung_bai_viet[0]['content']);
                $data = [
                    'chi_tiet_bai_viet' => $get_noi_dung_bai_viet[0]['content'],
                ];
                $format = array('%s');
                $where = ['link_bai_viet'=>$link_bai_viet];
                $wpdb->update($table_bai_viet, $data,$where ,$format);
            }
        }
    }


    // function lay noi dung cua mot bai viet
    function getContent($link, $att_content)
    {
        if ($this->html_content == '') {
            $this->html = file_get_html($link);
            $this->html_content = $this->html;
        } else {
            $this->html = $this->html_content;
        }

        foreach ($this->html->find($att_content) as $e) {
            $content_html = $e->innertext;
        }
        $this->html = str_get_html($content_html);

        foreach ($this->arr_att_clean as $att_clean) {
            // google+
            foreach ($this->html->find($att_clean) as $e) {
                $e->outertext = '';
            }
        }

        $ret = $this->html->save();
        return $ret;
    }

    // function remove het cac lien ket trong mot chuoi html truyen vao
    function removeLink($content)
    {
        $this->html = str_get_html($content);
        // link content
        foreach ($this->html->find('a') as $e) {
            $e->outertext = $e->innertext;
        }
        $ret = $this->html->save();
        return $ret;
    }

    // function xoa phan tu html cuoi cung
    function removeLastElement($content, $element)
    {
        $this->html = str_get_html($content);
        // link content
        $this->html->find($element, -1)->outertext = '';
        $ret = $this->html->save();
        return $ret;
    }

    // function xoa phan tu html truyen vao dau tien
    function removeFirstElement($content, $element)
    {
        $this->html = str_get_html($content);
        $this->html->find($element, 0)->outertext = '';
        $ret = $this->html->save();
        return $ret;
    }

}