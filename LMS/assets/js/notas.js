
  // Notificaciones al usuario 

  class animateNotifiers {
    constructor (container) {
      this.container = container;
    }
    show (arrNotifiers) {
      var el = document.getElementById(this.container);
      arrNotifiers.forEach( function (strNotifier, index) {
        var div = document.createElement('div');
        var splitNotifier = strNotifier.split("/");
        var textNotifier = document.createTextNode(splitNotifier[1]);
        div.setAttribute("id", "notifier-" + splitNotifier[0]);
        div.setAttribute("class", "notifier show");
        div.appendChild(textNotifier);
        div.style.animationDelay = (index / 5) + "s";
        el.appendChild(div);
      });
    }
    success (arrNotifierSuccess) {
      var el = document.getElementById(this.container);
      var splitNotifierSuccess = null;
      arrNotifierSuccess.forEach( (strNotifierSuccess) => {
        splitNotifierSuccess = strNotifierSuccess.split("/");
        var notifier = document.getElementById("notifier-" + splitNotifierSuccess[0]);
        notifier.classList.add('success');
        setTimeout(() => {
          notifier.remove();
        }, 5000);
      });
    }
  }

  /******** FUNCTIONS **********/

  function main() {

    var notifier = `<div id='box-notifier' class='notifiers'></div>`;
    
    // Agregar div que contendra las notificaciones
    $("#exampleModal").after(notifier);
  }

  function makeid () {

    // Generar string aleatorio

    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 12; i++){
      text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
  }

  
  function addCategory () {

    // Agregar tds para nueva categoria

    var btn = $(this);
    var elSiblings = btn.siblings('span');
    var boxCategory = elSiblings[0];
    var boxPorcent = elSiblings[1];
    btn.css("display","none");
    boxCategory.style.display = "inline-block";
    boxCategory.focus();
    withDinamicTable();
  }


  function withDinamicTable () {

  // Validar el tamanio de la tabla para mostrar el scrollbar horizontal En el top de la tabla

    var widthTable = $("#wrapperMain").width();
   
    var divScrollbarTop = Number($("#dinamicTable").width()) + 2000;

    $("#div1").width(divScrollbarTop);
    $("#wrapper2").width(widthTable);
    $("#wrapper1").width(widthTable);
    
    if ($("#dinamicTable").width() > 1100) {

      // Show scrollbar

      $("#div1").css("display","block");
    } else { 

      // Hide scrollbar

      $("#div1").css("display","none");
    }
  }

  function ajax(url,data,callback,errorcall) {

    // Requests with ajax

    $.ajax(
      { 
        url: url,
        type:"POST",
        dataType: 'json',
        data: data,
        beforeSend: function() {
        },
        success: function (data) {
          callback(data); 
        },
        error: function(xhr, status, error) {
          errorcall(xhr, status, error);
        },
        complete: function() {
        }
      }
    );
  }

  
  function keyDownPressCategory (e) {

    //  Insertar y editar categorias

    var keyCode = e.keyCode || e.which;
    var boxCategory = $(this);
    var idColCategory = boxCategory.parent().attr('data-category');
    var flagEdit = $(".col-add." + idColCategory + ".content-subcategory").length;

    
    if (keyCode === 13 && flagEdit === 1) {

      // Presionar enter sin agregar texto cuando se esta insertando la categoria
      
      return false
    }

    if (keyCode === 13 && flagEdit === 0) {

      // Editar o eliminar categoria al presionar enter

      if (boxCategory[0].textContent === '') {

      // Si se presiona enter y esta vacia la categoria eliminar

        var categoryText = boxCategory.parent().attr('data-text');
        var category = boxCategory.parent().attr('data-id');

        $("#modalDinamicTable").css("display","block");
        $("#modalDinamicTable .modal-content").addClass("slideDown");

        $("#modalDinamicTable .modal-content .message-title").text("Eliminación de categoria");
        $("#modalDinamicTable .modal-content .message").text("Desea eliminar la categoria ").append("<b>"+categoryText+ "?</b>");

        objDelete.el = idColCategory;
        objDelete.id = category;
        objDelete.text = categoryText;
        objDelete.tipo = 'category';
        objDelete.url = 'category_delete';

        return false
      
      } else {

        // Editar categoria

        boxCategory.attr('contenteditable','false');

        var route = `${baseUrl}category_update/`;

        var data = {
          "category" : boxCategory[0].textContent, 
          "id" : boxCategory.parent().attr('data-id'),
        };
        
        // id de la notificaicon
        var idNotifier = makeid();
        
        // id de notificacion y el texto de la notificacion
        arrNotif = [idNotifier +'/' + boxCategory[0].textContent];

        // Mostrar notificaicion
        AnimateNotifiers.show(arrNotif);

        ajax(
          route,
          data,
          function(response) {
            var res = response.data;
            if (res.status === 'success') {
              var arrNotifSuccess = [idNotifier + '/' + boxCategory[0].textContent];
              boxCategory.parent().attr('data-text',boxCategory[0].textContent);
              AnimateNotifiers.success(arrNotifSuccess);
            }
          },
          function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
          }
        );
      }
    }
    
    if (keyCode === 9 && flagEdit === 1) {
      // Presionar tab para insertar

      if (boxCategory[0].textContent === '') {
        // Si la categoria esta vacia

        boxCategory.css("display","none");
        boxCategory.siblings('button').css("display","inline");

      } else {
        // Sino esta vacia la categoria
        
        var newSubCategory = addSubCategory(idColCategory);

        var idNotifier = makeid();

        boxCategory.attr('contenteditable','false');
        boxCategory.siblings('span').css("display","inline");
        newcols($(this).parent().attr('data-col'));
        
        setTimeout(() => {
          $("." + newSubCategory +" .title").css('display', 'inline-block');
          $("." + newSubCategory +" .title").focus();
        }, 1000);

        var route = `${baseUrl}category_insert/`;

        var data = { 
          "category" : boxCategory[0].textContent, 
          "teacher" : boxCategory.parent().parent().attr('data-t'),
          "sub" : boxCategory.parent().parent().attr('data-s'),
          "class" : boxCategory.parent().parent().attr('data-c'),
          "exam" : boxCategory.parent().parent().attr('data-e')
        };
        
        // id de notificacion y el texto de la notificacion

        arrNotif = [idNotifier +'/' + boxCategory[0].textContent];
        
        // Mostrar notificacion

        AnimateNotifiers.show(arrNotif);

        ajax(
          route,
          data,
          function(response) {
            var res = response.data;
            if (res.status === 'success') {
              var arrNotifSuccess = [idNotifier + '/' + boxCategory[0].textContent];
              AnimateNotifiers.success(arrNotifSuccess);
              boxCategory.parent().attr('data-id',res.id);
              boxCategory.parent().attr('data-text',boxCategory[0].textContent);
            }
          },
          function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
          }
        );
      }
    }
  }

 
  function keyDownPressSubCategory (e) {

    //  Insertar y editar subcategorias

    var keyCode = e.keyCode || e.which;
    var category = $(this).parent().attr('data-category');
    var dataCol = $(this).parent().attr('data-col');
    var subcategory = $(this).parent().attr('data-subcategory');
    var boxSubCategory = $("." + subcategory +" .subcategory-text");
    var boxSubCategoryPorcent = $("." + subcategory +" .porcent");
    var editable = boxSubCategory.attr("data-edit");
 
    if ((keyCode === 13 && editable === 'false')) {

      // Presionar enter sin agregar texto cuando se esta insertando la subcategoria

      return false
    }

    if (keyCode === 13 && editable === 'true') {
      // Editar o eliminar la subcategoria al presionar enter

      if (boxSubCategory[0].textContent === '') {

        // Eliminar subcategoria

        var classSubcategory = subcategory;
        var colspan = Number($(".main." + category).attr("colspan")) - 1;
        subcategory = $(".sub." + subcategory).attr("data-id");
        var subcategoryText = boxSubCategory.parent().attr('data-text');

        $("#modalDinamicTable").css("display","block");
        $("#modalDinamicTable .modal-content").addClass("slideDown");

        $("#modalDinamicTable .modal-content .message-title").text("Eliminación de subcategoria");
        $("#modalDinamicTable .modal-content .message").text("Desea eliminar la subcategoria ").append("<b>"+subcategoryText+ "?</b>");

        objDelete.el = dataCol;
        objDelete.id = subcategory;
        objDelete.text = subcategoryText;
        objDelete.tipo = 'subcategory';
        objDelete.parentCategory = category;
        objDelete.url = 'subcategory_delete';

        return false;

      } else {

        var route = `${baseUrl}subcategory_update/`;

        var data = { 
          "subcategory_id" : boxSubCategory.parent().attr('data-id'), 
          "subcategory" : boxSubCategory[0].textContent
        };

        var idNotifier = makeid();

        // id de notificacion y el texto de la notificacion
        arrNotif = [idNotifier + '/' + boxSubCategory[0].textContent];
        
        // Mostrar notificacion
        AnimateNotifiers.show(arrNotif);

        ajax(
          route,
          data,
          function(response) {
            var res = response.data;
            if (res.status === 'success') {
              var arrNotifSuccess = [idNotifier + '/' + boxSubCategory[0].textContent];
              AnimateNotifiers.success(arrNotifSuccess);
              boxSubCategory.parent().attr('data-text',boxSubCategory[0].textContent);
            }
          },
          function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
          }
        );

        boxSubCategory.attr('contenteditable','false');
      }
    }

    if (keyCode === 9 && editable === 'false') {
      // Presionar tab para insertar

      if (boxSubCategory[0].textContent === '') {
        // Si esta vacia la subcategoria

        var colNextCategory = $(".main." + category + "+ td").attr("data-category");

        boxSubCategory.siblings('button').css('display','inline-block');

        if ($(".main." + colNextCategory + " .box-category")[0].textContent === '') {

          // Ir a la proxima categoria

          $(".main." + colNextCategory + " .btnAdd").css("display","none");

          $(".main." + colNextCategory + " .title.subcategory-text").css("display","inline-block").attr('contenteditable','true');

          setTimeout(() => {
            $(".main." + colNextCategory + " .title.subcategory-text").focus();
          }, 1000);
        }

      } else {
        // Insertar la subcategoria

        $('#dinamicTable tr td.col-' + dataCol + ' .box-nota').html('-').css("display","inline-block");
        $('#dinamicTable tr td.col-' + dataCol + '.col-subadd').removeClass("col-subadd");

        boxSubCategoryPorcent.css('display','inline-block');
        var idNewSubCategory = newColSubCategory(category,dataCol);
        var colSpan = incrementVal($(".main."+category).attr('colspan'));
        $(".main."+category).attr('colspan', colSpan);

                  
        var route = `${baseUrl}subcategory_insert/`;

        var data = { 
          "category_id" : $(".main."+category).attr('data-id'), 
          "subject_id" : boxSubCategory.parent().parent().attr('data-s'),
          "subcategory" : boxSubCategory[0].textContent
        };

        var idNotifier = makeid();
        arrNotif = [idNotifier + '/' + boxSubCategory[0].textContent];
    
        AnimateNotifiers.show(arrNotif);
        
        ajax(
          route,
          data,
          function(response) {
            var res = response.data;
            if (res.status === 'success') {
              var arrNotifSuccess = [idNotifier + '/' + boxSubCategory[0].textContent];
              AnimateNotifiers.success(arrNotifSuccess);

              boxSubCategory.parent().attr('data-id',res.id);
              boxSubCategory.attr({"contenteditable":"false","data-edit":"true"});
              boxSubCategory.parent().attr('data-text',boxSubCategory[0].textContent);
            }
          },
          function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
          }
        );

      }
    }
  }

  function keyDownPressPointsCategory (e) {

    //  Insertar puntaje categoria

    var keyCode = e.keyCode || e.which;
    var boxPorcent = $(this);

    if ((keyCode === 13 && Number(boxPorcent[0].textContent) > 100)) {

      // Validar que el puntaje sea menor a 100

      return false
    }

    if (keyCode === 13 && boxPorcent[0].textContent !== '') {

      // Presionar enter sino esta vacio el puntaje

      var route = `${baseUrl}points_category_insert/`;

      var idColCategory = boxPorcent.parent().parent().attr('data-category');
      
      var data = { 
        "id" : boxPorcent.parent().parent().attr('data-id'), 
        "points" : boxPorcent[0].textContent
      };
        
      var idNotifier = makeid();

      arrNotif = [idNotifier + '/' + boxPorcent.parent().siblings('span')[0].textContent + ' (' + boxPorcent[0].textContent + ')'];
    
      AnimateNotifiers.show(arrNotif);

      ajax(
        route,
        data,
        function(response) {
          var res = response.data;
          if (res.status === 'success') {
            var arrNotifSuccess = [idNotifier + '/' + boxPorcent.parent().siblings('span')[0].textContent + ' (' + boxPorcent[0].textContent + ')'];
            AnimateNotifiers.success(arrNotifSuccess);

            validatePointsTotalCategories();
            validatePointsSubcategories(idColCategory);
          }
        },
        function(xhr, status, error) {
          console.log(xhr);
          console.log(status);
          console.log(error);
        }
      );

      boxPorcent.attr('contenteditable','false');
    }
  }

  function keyDownPressPointsSubCategory (e) {

    //  Insertar puntaje subcategoria

    var keyCode = e.keyCode || e.which;
    var boxPorcent = $(this);
    var category = $(this).parent().parent().attr("data-category");
    var dataCol = $(this).parent().parent().attr("data-col");
    var max = Number($(".main." + category + " .points-category")[0].textContent);

    if ((keyCode === 13 && Number(boxPorcent[0].textContent) > max) || (keyCode === 13 && Number(boxPorcent[0].textContent) == 0 && max == 0)) {

      return false
    }

    if (keyCode === 13 && boxPorcent[0].textContent !== '') {

      // Insertar puntaje

      var route = `${baseUrl}points_subcategory_insert/`;
      
      var data = { 
        "id" : boxPorcent.parent().parent().attr('data-id'),
        "points" : boxPorcent[0].textContent
      };
        
      var idNotifier = makeid();
      arrNotif = [idNotifier + '/' + boxPorcent.parent().siblings('span')[0].textContent + ' (' + boxPorcent[0].textContent + ')'];
    
      AnimateNotifiers.show(arrNotif);
      
      ajax(
        route,
        data,
        function(response) {
          var res = response.data;
          if (res.status === 'success') {
            var arrNotifSuccess = [idNotifier + '/' + boxPorcent.parent().siblings('span')[0].textContent + ' (' + boxPorcent[0].textContent + ')'];
            AnimateNotifiers.success(arrNotifSuccess);
            
            if (res.update == '') {
              
              // Si el puntaje se actualizo y la subcategoria no tiene notas

              validatePointsSubcategories(boxPorcent.parent().parent().attr("data-category"));
              validatePointsTotalSubcategories();
            }

            if (res.update !== '') {

              // Si el puntaje se actualizo y la subcategoria tiene notas, se actualizan las notas en la vista

              var data = res.update;

              for(var i in data)
              {
                idNotif = makeid();
                var studentName = $("#dinamicTable tr[data-num='" + data[i].student + "'] td").eq(1).text();
                var notaStudent = Number(data[i].nota).toFixed(2);
                arrNotif = [idNotif + '/' + studentName + ' (' + notaStudent + ')'];
                AnimateNotifiers.show(arrNotif);
                arrNotifSuccess = [idNotif + '/' + studentName + ' (' + notaStudent + ')'];
                AnimateNotifiers.success(arrNotifSuccess);

                $("#dinamicTable tr[data-num='" + data[i].student + "'] .col-" + dataCol + ":not('.sub') .box-nota").text(notaStudent);
                validatePointsSubcategories($("#dinamicTable .col-" + dataCol + ".sub").attr('data-category'));
                calcTotalsNotasStudent(data[i].student);
              }
              validatePointsTotalSubcategories();
              totalNotasAllSubcategories();
              studentSuccess();
            }
          }
        },
        function(xhr, status, error) {
          console.log(xhr);
          console.log(status);
          console.log(error);
        }
      );

      boxPorcent.attr('contenteditable','false');
    }
  }


  function porcentToPoints (cant, porcent) {

    // Convertir porcentaje a puntos

    return cant * porcent / 100;
  }

  function calcTotalNota (attr, nota) {

    // Calcular puntaje total de un estudiante en base a la nota en una subcategoria

    var totalNotaStudent = Number($("tr[data-num='"+ attr +"'] .total-student").text());
    var total = totalNotaStudent + Number(nota);

    $("tr[data-num='"+ attr +"'] .total-student").text(total.toFixed(2));
  }

  function calcTotalsNotasStudent (attr) {

    // Calcular puntaje total en base a todas la notas registradas para el estudiante en cada subcategoria

    var total = 0;
    $("#dinamicTable tr[data-num='" + attr +"']").each(function(index) {
      $(this).find('td .box-nota').each (function() {
        if ($(this)[0].textContent != '-' && $(this)[0].textContent != '') {
          total = total + Number($(this).text());
        }
      });
    });
    $("tr[data-num='"+ attr +"'] .total-student").text(total.toFixed(2));
  }

  function calcTotalsNotasAllStudents () {

    // Calcular puntajes totales de todos los estudiantes en base a todas la notas registradas en cada subcategoria

    $(".total-student").text(0);
    $("#dinamicTable tr").each(function(index) {
      $(this).find("td .box-nota").each (function() {
        if ($(this)[0].textContent != '-' && $(this)[0].textContent != '') {
          calcTotalNota($(this).parent().parent()[0].attributes[4].nodeValue, $(this).text());
        }
      }); 
    });
  }

  function studentSuccess () {

    // highligh estudiantes aprobados y reprobados

    $("#dinamicTable tr[data-num]").each(function(index) {
      var el = $(this).attr("data-num");
      var minimo = Number($(this).attr("data-mn"));

      $(this).find("td").last().each (function() {
        var totalPointsStudent = Number($(this).find(".total-student").text());
        var totalPointsSubcategories = Number($(this).find(".total-student-subcategories").text());
        $(this).css({"background" : "inherit" , "color" : "inherit"});
        if (totalPointsSubcategories === 100) {
          if (totalPointsStudent >= minimo) {
            $(this).css({"background" : "rgba(98, 210, 98, 0.72)" , "color" : "rgb(255, 255, 255)"});
          } else {
            $(this).css({"background" : "rgb(241, 93, 93)" , "color" : "rgb(255, 255, 255)"});
          }
        }
      }); 
    });
  }
  

  function totalNotasSubcategoryStudents (classSubcategory, totalPointsSubcategory) {

    /* Validar que el usuario a terminado de ingresar las notas para una subcategoria cuando todos
los alumnos tengan las notas ingresadas, es decir que se sabra que se han jugado por ej 15 puntos de 100*/

    var totalNotasSubcategoriesStudent = $("#dinamicTable td[data-subcategory='" + classSubcategory +"']:not('.sub')").length;
    var pointsSubcategory = Number($(".sub." + classSubcategory + " .points-subcategory").text());
    var itemStudent = 0;
    
    $("#dinamicTable td[data-subcategory='" + classSubcategory +"']:not('.sub')").each(function(index) {
      $(this).find('.box-nota').each (function() {
        if ($(this)[0].textContent != '-' && $(this)[0].textContent != '') {
          itemStudent++;
        }
      });
    });
    if (totalNotasSubcategoriesStudent == itemStudent) {
      
      var total = Number($(".total-student-subcategories").eq(0).text());
      totalPointsSubcategory = total  + pointsSubcategory;

      if (pointsSubcategory > 0) {
        $(".total-student-subcategories").text(totalPointsSubcategory.toFixed(2));
      }
    }
  }


  function totalNotasAllSubcategories () {

    // Calcular el puntaje total de todas las subcategorias

    $(".total-student-subcategories").text(0);
    var totalPointsSubcategory = 0;
    $("#dinamicTable tr").eq(1).each(function(index) {
      $(this).find("td.sub:not('.col-subadd')").each (function() {
        if ($(this).attr("data-text") !== undefined) {
          totalNotasSubcategoryStudents($(this).attr("data-subcategory"), totalPointsSubcategory);
        }
      });
    });
  }

  function keyDownPressPoints (e) {

    //  Insertar puntaje de los estudiantes

    var keyCode = e.keyCode || e.which;
    var boxNota = $(this);
    var flagEdit = boxNota.parent().attr('data-edit');
    var p = boxNota.parent().attr('data-col');
    var idSubCategory = boxNota.parent().attr('data-subcategory');
    var idCategory = $(".sub." + idSubCategory).attr("data-category");
    var alumno = boxNota.parent().parent().children()[1].textContent;
    var maxPointsSubcategory = Number($(".sub." + idSubCategory + " .points-subcategory")[0].textContent);
    var notaStudent = boxNota[0].textContent;

    if (boxNota[0].textContent.indexOf("p") > 0) {

      // Convertir puntaje a porcentaje, caso con letra "p"

      var position = boxNota[0].textContent.indexOf("p");
      var porcentNota = boxNota[0].textContent.substring(0, Number(position));
      notaStudent = porcentToPoints(maxPointsSubcategory, Number(porcentNota));
    }

    if (boxNota[0].textContent.indexOf("%") > 0) {

      // Convertir puntaje a porcentaje, caso con simbolo "%"

      var position = boxNota[0].textContent.indexOf("%");
      var porcentNota = boxNota[0].textContent.substring(0, Number(position));
      notaStudent = porcentToPoints(maxPointsSubcategory, Number(porcentNota));
    }

    if ((keyCode === 13 && notaStudent > maxPointsSubcategory) || (keyCode === 13 && notaStudent == '') || (keyCode === 13 && notaStudent == '' && maxPointsSubcategory == '') || (keyCode === 13 && notaStudent == 0 && maxPointsSubcategory == 0) || (keyCode === 9 && notaStudent > maxPointsSubcategory) || (keyCode === 9 && notaStudent == '') || (keyCode === 9 && notaStudent == '' && maxPointsSubcategory == '') || (keyCode === 9 && notaStudent == 0 && maxPointsSubcategory == 0)) {
      
      if (flagEdit === 'false') {
        boxNota.text('-').attr('contenteditable','false');
      }
      
      return false
    }
    
    if ((keyCode === 13 && boxNota[0].textContent !== '') || (keyCode === 9 && boxNota[0].textContent !== '')) {

      // Si presiona enter o tab y no esta vacio el puntaje

      var category = Number($(".main." + idCategory).attr("data-id"));
      var subcategory = Number($(".sub." + idSubCategory).attr("data-id"));
      var student = Number(boxNota.parent().parent().attr('data-num'));
      var exam = Number(boxNota.parent().parent().attr('data-e'));
      var subject = Number(boxNota.parent().parent().attr('data-s'));
      var classStudent = Number(boxNota.parent().parent().attr('data-c'));
      var section = Number(boxNota.parent().parent().attr('data-st'));
      
      if (flagEdit === 'false') {
        
        // Insertar puntaje
        
        var route = `${baseUrl}nota_insert/`;

        var data = { 
          "category" : category,
          "subcategory" : subcategory,
          "student" : student,
          "exam" : exam,
          "subject" : subject,
          "class" : classStudent,
          "section" : section,
          "nota" : notaStudent
        };
        
        var idNotifier = makeid();
        arrNotif = [idNotifier + '/' + alumno + ' (' + notaStudent + ')'];
      
        AnimateNotifiers.show(arrNotif);

        ajax(
          route,
          data,
          function(response) {
            var res = response.data;
            if (res.status === 'success') {
              var arrNotifSuccess = [idNotifier + '/' + '(' + notaStudent + ')'];
              AnimateNotifiers.success(arrNotifSuccess);
              boxNota.text(notaStudent);
              boxNota.parent().attr({'data-edit':'true','data-id' : res.id});
              calcTotalsNotasStudent(boxNota.parent().parent()[0].attributes[4].nodeValue);
              totalNotasAllSubcategories();
              studentSuccess();

              if (keyCode === 9) {

                // Si presiona tab navegar a si el proximo estudiante de esa subcategoria para agregar puntaje

                if (boxNota.parent().parent().next().length === 1) {
                  var dataCol = $(".sub." + idSubCategory).attr("data-col");
                  boxNota.parent().parent().next().find(".col-" + dataCol + " .box-nota").attr("contenteditable","true").text('').focus();
                }
              }
            }
          },
          function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
          }
        );

        boxNota.attr('contenteditable','false');
      }

      if (flagEdit === 'true') {

        // Editar puntaje

        var id = boxNota.parent().attr('data-id');
        var route = `${baseUrl}nota_update/`;

        var data = { 
          "id" : id,
          "nota" : notaStudent
        };
        
        var idNotifier = makeid();
        arrNotif = [idNotifier + '/' + alumno + ' (' + notaStudent + ')'];
      
        AnimateNotifiers.show(arrNotif);

        ajax(
          route,
          data,
          function(response) {
            var res = response.data;
            if (res.status === 'success') {
              var arrNotifSuccess = [idNotifier + '/' + '(' + notaStudent + ')'];
              AnimateNotifiers.success(arrNotifSuccess);
              boxNota.text(notaStudent);
              calcTotalsNotasStudent(boxNota.parent().parent()[0].attributes[4].nodeValue);
              totalNotasAllSubcategories();
              studentSuccess();
              if (keyCode === 9) {
                if (boxNota.parent().parent().next().length === 1) {

                  // Si presiona tab navegar a si el proximo estudiante de esa subcategoria para agregar puntaje

                  var dataCol = $(".sub." + idSubCategory).attr("data-col");
                  boxNota.parent().parent().next().find(".col-" + dataCol + " .box-nota").attr("contenteditable","true").text('').focus();
                }
              }
            }
          },
          function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
          }
        );

        boxNota.attr('contenteditable','false');
      }
    }
  }

  /* Incrementar en uno el valor pasado como argumento */
  function incrementVal (val) {
    var i = Number(val) + 1;
    return i
  }

  // Identificar si la categoria se modificara (Editar, Eliminar)
  function editable () {
    if ($(this)[0].classList.contains('box-nota') && $(this)[0].textContent === '-') {
      $(this)[0].textContent = '';
    }
    $(this).attr('contenteditable','true');
    $(this).focus();
  }

  /* Desahabilitar categoria o subcategoria al hacer click fuera de su elmento
  o cambiar el focus a otro elemento */
  function focusOut () {

    if ($(this)[0].textContent === '') {
      // Si esta vacia la categoria o subbcategoria

      $(this).css("display","none");
      $(this).siblings('button').css("display","inline-block");
    }
  }

  /* Click en el button de agregar subcategoria */
  function showSubCategory () {

    var subcategory = $(this).parent().attr("data-subcategory");
    var boxSubCategory = $("." + subcategory +" .title.subcategory-text");
    console.log("." + subcategory +" .title.subcategory-text");
    $(this).css("display","none");
    boxSubCategory.css("display","inline-block").attr("contenteditable","true");
    setTimeout(() => {
      boxSubCategory.focus();
    }, 1000);
  }

  /* Agregar nuevo td para la categoria nueva */
  function newcols (col) {
    
    var col =  makeid();

    var idSubCategory = makeid();

    var tdAddCategory = `<td class='col-add main category-${col}' data-col="${col}" data-category="category-${col}" colspan="1">
                          <span class='box-category title focus-out editable subcategory-text' style='display:none' contenteditable='true'></span>
                          <span class='porcent' style='display:none' contenteditable='false'>(<b class="editable validate-points points-category">0.00</b>)</span>
                          <button class='btnAdd' style='display:inline-block'>+</button>
                        </td>`;

    var tdSubCategory = `<td class='col-${col} content-subcategory sub col-add category-${col}' data-col="${col}" data-category="category-${col}"></td>`;

    var td = `<td class='col-add col-${col} category-${col}' data-col="${col}" data-category="category-${col}" data-edit="false" colspan="1">
                <span class="box-nota editable" style='display:none' contenteditable='false'></span>
              </td>`;

    $('#dinamicTable tr td.col-add').each(function(index) {
      if (index === 0) {
        $(tdAddCategory).insertAfter($(this));
      } else if (index === 1) {
        $(tdSubCategory).insertAfter($(this));
      }else {
        $(td).insertAfter($(this));
      }
      $(this).removeClass("col-add");
    });

    withDinamicTable();
  }

  /* AL hacer click en agregar nueva categoria se agrega una subcategoria a la que se le hizo click*/
  function addSubCategory (category) {
    var id = makeid();
    var dataColCategory = $('.main.' + category).attr('data-col');
    var classSubcategory = `subcategory-${id}`;

    var subcategory = `<span class='box-subcategory title editable focus-out subcategory-text' style='display:inline-block' contenteditable='true' data-edit="false"></span>
                       <span class='porcent' style='display:none' contenteditable='false'>(<b class="editable validate-points points-subcategory">0.00</b>)</span>
                       <button class='btnAddSubItems' style='display:none'>+</button>`;

    $('.' + category + '.content-subcategory').html(subcategory).removeClass('content-subcategory');
    
    $('.col-' + dataColCategory).attr('data-subcategory',classSubcategory).attr('data-colcategory',dataColCategory).addClass(classSubcategory);

    withDinamicTable();

    return classSubcategory;
  }

  /* Agregar una nueva subcategoria */
  function newColSubCategory (category, dataCol) {

    var id = makeid();
    var dataColCategory = $(".main." + category).attr('data-col');
    var tdSubCategory = `<td class="col-${id} ${category} sub col-subadd subcategory-${id}" data-category='${category}' data-subcategory="subcategory-${id}" data-col='${id}' data-colcategory='${dataColCategory}'>
                          <span class='box-subcategory title editable focus-out subcategory-text' style='display:inline-block' contenteditable='true' data-edit="false"></span>
                          <span class='porcent' style='display:none' contenteditable='false'>(<b class="editable validate-points points-subcategory">0.00</b>)</span>
                          <button class='btnAddSubItems' style='display:none'>+</button>
                        </td>`;
    var td = `<td class='col-${id} ${category} col-subadd' data-category='${category}' data-subcategory="subcategory-${id}" data-col='${id}' data-colcategory='${dataColCategory}' data-edit='false'>
                <span class="box-nota editable" style='display:none' contenteditable='false'></span>
              </td>`;

    $('#dinamicTable tr td.col-'+dataCol).each(function(index, item) {
      if (index === 0) {
        $(tdSubCategory).insertAfter(this);
      } else {
        $(td).insertAfter(this);
      }
    });

    withDinamicTable();

    return id;
  }

  function keypressValidate (e) {

    // Validar teclas disponibles para ingresar puntaje categorias y subcategorias

    var keyCode = e.keyCode || e.which;

    if ( ! (keyCode > 45 && keyCode < 59)) {
      // Solo numeros

      return false;
    }

  }

  function keypressValidateNotas (e) {

    // Validar teclas disponibles para ingresar puntaje de estudiantes

    var keyCode = e.keyCode || e.which;
    if ( ! (keyCode > 45 && keyCode < 59) && (keyCode !== 190) && (keyCode !== 112) && (keyCode !== 37)) {
      // Solo numeros, la letra p minuscula, el simbolo % y el punto

      return false;
    }

  }

  function validatePointsSubcategories (classCategory) {

    // Validar los puntajes que se agregan a las subcategorias los cuales no deben superar el puntaje asignado en su categoria.

    var category = $("." + classCategory + " .points-category");
    var pointsCategory = Number(category.text());
    var totalSubcategories = 0;

    $(".sub:not('.col-subadd')." + classCategory + " .points-subcategory").each(function(index, item) {
      totalSubcategories = totalSubcategories + Number($(this).text());
    });
    if (totalSubcategories !== pointsCategory) {
      category.addClass('has-warning');
    } else {
      category.removeClass('has-warning');
    }
  }

  function validatePointsTotalCategories (init = false) {

    // Agregar highlight al total de las categorias si el puntaje que ingresa el usuario para las categorias es diferente de 100 puntos.

    var totalCategoryPoints = $("#totalCategory");
    var totalCategories = 0;
    $(".main:not('.col-add') .points-category").each(function(index, item) {
      totalCategories = totalCategories + Number($(this)[0].textContent);
      if (init) {
        validatePointsSubcategories($(this).parent().parent().attr("data-category"));
      }
    });

    if (totalCategories !== 100 ) {
      totalCategoryPoints.addClass('has-warning');
      totalCategoryPoints.text(totalCategories.toFixed(2));
    } else {
      totalCategoryPoints.removeClass('has-warning');
      totalCategoryPoints.text(totalCategories.toFixed(2));
    }
  }

  function validatePointsTotalSubcategories (init = false) {

    // Agregar highlight al total de las subcategorias si los puntos ingresados para las subcategorias estan por encima o por debajo de los 100.

    var totalSubcategoryPoints = $("#totalSubcategory");
    var totalSubcategories = 0;
    $(".sub:not('.col-subadd') .points-subcategory").each(function(index, item) {
      totalSubcategories = totalSubcategories + Number($(this)[0].textContent);
    });

    if (totalSubcategories !== 100 ) {
      totalSubcategoryPoints.addClass('has-warning');
      totalSubcategoryPoints.text(totalSubcategories.toFixed(2));
    } else {
      totalSubcategoryPoints.removeClass('has-warning');
      totalSubcategoryPoints.text(totalSubcategories.toFixed(2));
    }
  }

  function deleteItem () {

    // Eliminar categoria y subcategoria

    var route = baseUrl + objDelete.url;

    var data = { 
      "item" : objDelete.id
    };

    ajax(
      route,
      data,
      function(response) {
        var res = response.data;
        if (res.status === 'success') {
          $("#modalDinamicTable .modal-content").removeClass('slideDown').addClass('slideDownOut');

          if (objDelete.tipo === 'category') {
            setTimeout(() => {
              $("#modalDinamicTable").css("display","none");
              $("." + objDelete.el ).remove();
              validatePointsTotalCategories();
              validatePointsTotalSubcategories();
              calcTotalsNotasAllStudents();
              totalNotasAllSubcategories();
              studentSuccess();
              withDinamicTable();              
              $("#modalDinamicTable .modal-content").removeClass('slideDownOut');
            }, 1200);
          }
          
          if (objDelete.tipo === 'subcategory') {
            var colspan = Number($(".main." + objDelete.parentCategory).attr("colspan")) - 1;
            setTimeout(() => {
              $("#modalDinamicTable").css("display","none");
              $(".col-" + objDelete.el).remove();
              $(".main." + objDelete.parentCategory).attr("colspan",colspan);
              validatePointsSubcategories(objDelete.parentCategory);
              validatePointsTotalSubcategories();
              calcTotalsNotasAllStudents();
              totalNotasAllSubcategories();
              studentSuccess();
              withDinamicTable();              
              $("#modalDinamicTable .modal-content").removeClass('slideDownOut');
            }, 1200);
          }
        }
      },
      function(xhr, status, error) {
        console.log(xhr);
        console.log(status);
        console.log(error);
      }
    );
  }

  function cancelItemDelete () {

    // Cancelar eliminacion de categoria y subcategoria

    $("#modalDinamicTable .modal-content").removeClass('slideDown').addClass('slideDownOut');

    if (objDelete.tipo === 'category') {
      $("." + objDelete.el + " .box-category").text(objDelete.text).css("display","inline-block").attr("contenteditable","false");
      $("." + objDelete.el + " .btnAdd").css("display","none");
      setTimeout(() => {
        $("#modalDinamicTable").css("display","none");
        $("#modalDinamicTable .modal-content").removeClass('slideDownOut');
      }, 1200);
    }

    if (objDelete.tipo === 'subcategory') {
      $(".col-" + objDelete.el + " .box-subcategory").text(objDelete.text).css("display","inline-block").attr("contenteditable","false");
      $(".col-" + objDelete.el + " .btnAddSubItems").css("display","none");
      setTimeout(() => {
        $("#modalDinamicTable").css("display","none");
        $("#modalDinamicTable .modal-content").removeClass('slideDownOut');
      }, 1200);
    }
  }

  /************** Init ****************/

  $(document).ready(main);

  // Agregar una categoria al hacer click al button
  $("#dinamicTable").on("click", ".btnAdd", addCategory);

  // Agregar una subcategoria al hacer click a button
  $("#dinamicTable").on("click", ".btnAddSubItems", showSubCategory);

  // Activar la edicion al hacer click al elemento
  $("#dinamicTable").on("click", ".editable", editable);

  // Validar las teclas que el usuario puede usar para agregar puntaje a categoiras y subcategoiras
  $("#dinamicTable").on("keypress", ".validate-points", keypressValidate);

  // Validar las teclas que el usuario puede usar para ingresar notas
  $("#dinamicTable").on("keypress", ".box-nota", keypressValidateNotas);

  // Insertar y editar categorias
  $("#dinamicTable").on("keydown", ".box-category", keyDownPressCategory);

  // Insertar y editar subcategorias
  $("#dinamicTable").on("keydown", ".box-subcategory", keyDownPressSubCategory);

  // Insertar y editar puntaje de categorias
  $("#dinamicTable").on("keydown", ".points-category", keyDownPressPointsCategory);

  // Insertar y editar puntaje de subcategorias
  $("#dinamicTable").on("keydown", ".points-subcategory", keyDownPressPointsSubCategory);

  // Insertar y editar puntaje de estudiantes
  $("#dinamicTable").on("keydown", ".box-nota", keyDownPressPoints);

  // Focus out al hacer click fuera del box de categoria o subcategoria
  $("#dinamicTable").on("focusout", ".focus-out", focusOut);

  // Hacer click en el button de eliminar del modal
  $("body").on("click", "#delete", deleteItem);

  // Hacer click en el boton de cancelar eliminacion del modal
  $("body").on("click", ".close-modal", cancelItemDelete);

  var wrapper1 = document.getElementById('wrapper1');
  var wrapper2 = document.getElementById('wrapper2');
  var url = window.location.pathname;
  var protocol = window.location.protocol;
  var host = window.location.host;
  var splitUrl = url.split("/");
  var baseUrl = `${protocol}//${host}/${splitUrl[1]}/${splitUrl[2]}/`;
  var objDelete = {"el" : null, "id" : null, "text" : null, "url" : null, "tipo" : null};
  var AnimateNotifiers = new animateNotifiers('box-notifier');

  wrapper1.onscroll = function() {
    wrapper2.scrollLeft = wrapper1.scrollLeft;
  };
  wrapper2.onscroll = function() {
    wrapper1.scrollLeft = wrapper2.scrollLeft;
  };

  withDinamicTable();
  validatePointsTotalCategories(true);
  validatePointsTotalSubcategories();
  totalNotasAllSubcategories();
  calcTotalsNotasAllStudents();
  studentSuccess();