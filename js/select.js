window.addEventListener("load",main)
var select, selected_op = new Object ();

function main(params) {
  select = document.getElementsByClassName('prof')
  
  var ind = 0;
  while (ind < select.length)
      {
        select [ind].addEventListener ("change", updateSelects);
        ind ++;
      }
}

function updateSelects(event) {
  var selected = event.target;

  var ind = 0;
  while (ind < select.length)
      {
        if (select [ind] == selected)
            {
              ind ++;
              continue;
            }

        var c_ind = 0;
        var option = select [ind].children;
        while (c_ind < option.length)
            {
              if (c_ind == selected.selectedIndex)
                  {
                    selected_op [selected.name] = selected.selectedIndex;
                    option [c_ind].hidden = true;
                  }
              c_ind ++;
            }
        ind ++;
      }

  ind = 0;
  for (ind in select)
      {
        if (isNaN (parseInt (ind)))
            {  continue;  }

        var option = select [ind].children;
        for (c_ind in option)
            {
              if (isNaN (parseInt (c_ind)))
                  {  continue;  }
              var found = false;
              for (opt in selected_op)
                  {
                    if (c_ind == selected_op [opt])
                        {
                          found = true;
                          break;
                        }
                  }
              if (!found)
                  {
                    option [c_ind].hidden = false;
  //                  console.log (option [c_ind].innerText, option [c_ind].hidden);
                  }
            }
//        console.log (ind, select [ind]);
      }
}
