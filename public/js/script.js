    // Contains Victorian public holidays which date selection needs to be restricted
    var vicHolidays = [
        {
          date: '2023-01-25',
          desc: 'Holiday'
        }, 
        {
          date: '2023-01-30',
          desc: 'Holiday2'
        }
        ];
      
      $(function() {
        $("#sel_date").datepicker({
          firstDay: 1,    // First day of the week
          minDate: 2,     // Start of date selection
          maxDate: '10w',  // End of date selection
          dateFormat: 'yy-mm-dd',
          
          /**
           * A function that takes a date as a parameter and must return an array with:
           * [0]: true/false indicating whether or not this date is selectable
           * [1]: a CSS class name to add to the date's cell or "" for the default presentation
           * [2]: an optional popup tooltip for this date
           * 
           */
          beforeShowDay: function(date) {
                      var result = [true, "", ""];
                      result = $.datepicker.noWeekends(date);
                      
                      if (vicHolidays === null) {
                          result[1] = "";
                      } else {
                        // Format the date in the format dd/mm/yy
                          var key = $.datepicker.formatDate("yy-mm-dd", date);
                       

              // Go through the defined Victorian holidays
                        for (var i=0; i<vicHolidays.length; i++) {
                if (key == vicHolidays[i].date) {
                              result[0] = false;
                                result[1] = "dp-highlight-holiday";
                                result[2] = vicHolidays[i].desc;
                }					     
                        }
                      }
                      return result;
                  }
        });
      });
  