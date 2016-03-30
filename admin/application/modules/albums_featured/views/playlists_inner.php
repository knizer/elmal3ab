
		<?php foreach ($news as $article) {
                 echo'<div id="from_'.$article->id.'" class="fc-field"><p class="p-class">'.substr($article->title, 0,200).'</p><br><div style="font-size: 13px;">'.$article->created_at.' - ';
                 if($article->published==1){
                     echo "تم نشره";
                 }elseif($article->published==0)
                     echo "جديد";
               //  echo '<a  onclick="ViewArticle('.$article->id.','.$article->published.',\''.$article->created_at.'\',\''.trim($article->title).'\')"><div style="color: blue;  margin-right: 90%;margin-top: -6%;">عرض</div></a></div></div>';
                  echo '<a href="#" onclick="ViewArticle('.$article->id.','.$article->published.',\''.$article->created_at.'\',\''.str_replace('"','',trim($article->title)).'\')"><div style="color: blue;  margin-right: 90%;margin-top: -6%;">عرض</div></a></div></div>';

                         } ?>	
 