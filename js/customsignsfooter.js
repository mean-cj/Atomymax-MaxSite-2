/** RSH must be initialized after the
    page is finished loading. 
	*/
//window.onload = initialize; 

//function initialize() {
  // initialize RSH
  
  window.historyStorage.init();
window.dhtmlHistory.create();
  dhtmlHistory.initialize();

  
  // add ourselves as a listener for history
  // change events
  dhtmlHistory.addListener(handleHistoryChange);
  
/** A function that is called whenever the user
    presses the back or forward buttons. This
    function will be passed the newLocation,
    as well as any history data we associated
    with the location.*/ 
	
	function handleHistoryChange(newLocation,
								 historyData) {
	  // use the history data to update our UI
	  
	}
	
