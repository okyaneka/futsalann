<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('bootstrap_panel')) 
{
	/**
	 *
	 */
	function bootstrap_panel($data='',$title='',$footer='',$type='panel-default')
	{
      $panel = '<div class="panel '.$type.'">';
  		if (is_array($data)) 
  		{
  			$panel = !isset($data['type']) ? '<div class="panel panel-default">' : '<div class="panel '.$data['type'].'">' ;
  			$panel .= isset($data['title']) ? '<div class="panel-heading"><h3 class="panel-title">'.$data['title'].'</h3></div>' : '';
  			$panel .= isset($data['content']) ? '<div class="panel-body">'.$data['content'].'</div>' : '';
  			$panel .= isset($data['footer']) ? '<div class="panel-footer">'.$data['footer'].'</div>' : '';
  		}
  		else 
  		{
  			$panel .= !empty($title) ? '<div class="panel-heading"><h3 class="panel-title">'.$title.'</h3></div>' : '';
  			$panel .= '<div class="panel-body">'.$data.'</div>';
  			$panel .= !empty($footer) ? '<div class="panel-footer">'.$footer.'</div>' : '';
  		}
  		$panel .= '</div><!-- .panel -->';

		return $panel;
	}
}

if ( ! function_exists('bootstrap_listgroup_collapse')) 
{
	function bootstrap_listgroup_collapse($list='', $title='')
	{
		$id = str_replace(' ', '-', strtolower($title));
		$listgroup = '<div class="list-group">';
		$listgroup .= '<a href="#" class="list-group-item" data-toggle="collapse" data-target="#'.$id.'"><strong>'.$title.'</strong></a>';
		$listgroup .= '<div id="'.$id.'" class="collapse in">';
		
		if (isset($list['url'])) 
		{
			$listgroup .= anchor($list['url'], $list['title'], 'class="list-group-item"');
		}
		else
		{
			foreach ($list as $item) 
			{
				$listgroup .= anchor($item['url'], $item['title'], 'class="list-group-item"');
			}	
		}
		
		$listgroup .= '</div></div><!-- .list-group -->';
    	
    	return $listgroup;
	}
}

if ( ! function_exists('bootstrap_breadcrumb')) 
{
	function bootstrap_breadcrumb($data='')
	{
		$limiter = '<i class="p-x-15">/</i>';

		$breadcrumb = '<div class="well well-sm m-x-15">';
		$breadcrumb .= '<div class="p-x-15">';

		if (is_array($data)) 
		{
			if (count($data) < 1)
			{
				$breadcrumb .= $data[0];
			}
			else
			{
				for ($i=0; $i < count($data); $i++) 
				{ 
					$breadcrumb .= $data[$i];
					$breadcrumb .= ($i+1 < count($data)) ? $limiter : '' ;
				}
			}
		}
		elseif (empty($data)) 
		{
			return '';
		}
		else
		{
			$breadcrumb .= $data;
		}
		
		$breadcrumb .= '</div>';
		$breadcrumb .= '</div>';

		return $breadcrumb;
	}
}

if ( ! function_exists('bootstrap_badge'))
{
	function bootstrap_badge($content='')
	{
		$badge = empty($content) ? '' : '<span class="badge">'.$content.'</span>';

		return $badge;
	}
}

if ( ! function_exists('bootstrap_label'))
{
	function bootstrap_label($content='', $style='label-default')
	{
		if (stripos($style, 'label') !== FALSE) 
		{
			$style = 'label-'.$style;
		}

		$label = empty($content) ? '' : '<span class="label '.$style.'">'.$content.'</span>';

		return $label;
	}
}