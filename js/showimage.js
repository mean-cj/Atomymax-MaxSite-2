    function showimage() 
     { 
      if (!document.images) 
       return 
       document.images.pictures.src= 
       document.form.templates.options[document.form.templates.selectedIndex].value 
     }   
    </script>