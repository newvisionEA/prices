   

    function treetable_eventRowChanged(rowId, state) {

      img = document.getElementById(rowId).getElementsByTagName('td')[0].getElementsByTagName('img')[0];

      if (state == 1) {

        img.src = 'images/folder_green_open.png';

      } else {

        img.src = 'images/folder_green.png';

      }

      return (true);

    }  
