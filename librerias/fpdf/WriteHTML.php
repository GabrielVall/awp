<?php
require_once('fpdf.php');

class PDF_HTML extends FPDF
{
    var $B=0;
    var $I=0;
    var $U=0;
    var $HREF='';
    var $ALIGN='';

    function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                elseif($this->ALIGN=='center')
                    $this->Cell(0,5,$e,0,1,'C');
                else
                    $this->Write(5,$e);
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract properties
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $prop=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $prop[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$prop);
                }
            }
        }
    }

    function OpenTag($tag,$prop)
    {
        //Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF=$prop['HREF'];
        if($tag=='BR')
            $this->Ln(5);
        if($tag=='P')
            $this->ALIGN=$prop['ALIGN'];
        if($tag=='HR')
        {
            if( !empty($prop['WIDTH']) )
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $this->Ln(2);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.4);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(2);
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag,$enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('',$style);
    }

    function PutLink($URL,$txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
    function Image($file, $x = null, $y = null, $w = 0, $h = 0, $type = '', $link = '')
	{
		// Put an image on the page
		if ($file == '')
			$this->Error('Image file name is empty');
		if (!isset($this->images[$file])) {
			// First use of this image, get info
			if ($type == '') {
				$pos = strrpos($file, '.');
				if (!$pos)
					$this->Error('Image file has no extension and no type was specified: ' . $file);
				$type = substr($file, $pos + 1);
			}
			$type = strtolower($type);
			if ($type == 'jpeg')
				$type = 'jpg';
			$mtd = '_parse' . $type;
			if (!method_exists($this, $mtd))
				$this->Error('Unsupported image type: ' . $type);
			$info = $this->$mtd($file);
			$info['i'] = count($this->images) + 1;
			$this->images[$file] = $info;
		} else
			$info = $this->images[$file];

		// Automatic width and height calculation if needed
		if ($w == 0 && $h == 0) {
			// Put image at 96 dpi
			$w = -96;
			$h = -96;
		}
		if ($w < 0)
			$w = -$info['w'] * 72 / $w / $this->k;
		if ($h < 0)
			$h = -$info['h'] * 72 / $h / $this->k;
		if ($w == 0)
			$w = $h * $info['w'] / $info['h'];
		if ($h == 0)
			$h = $w * $info['h'] / $info['w'];

		// Flowing mode
		if ($y === null) {
			if ($this->y + $h > $this->PageBreakTrigger && !$this->InHeader && !$this->InFooter && $this->AcceptPageBreak()) {
				// Automatic page break
				$x2 = $this->x;
				$this->AddPage($this->CurOrientation, $this->CurPageSize, $this->CurRotation);
				$this->x = $x2;
			}
			$y = $this->y;
			$this->y += $h;
		}

		if ($x === null)
			$x = $this->x;
		$this->_out(sprintf('q %.2F 0 0 %.2F %.2F %.2F cm /I%d Do Q', $w * $this->k, $h * $this->k, $x * $this->k, ($this->h - ($y + $h)) * $this->k, $info['i']));
		if ($link)
			$this->Link($x, $y, $w, $h, $link);
	}
}
?>