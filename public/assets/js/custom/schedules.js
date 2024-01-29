// let editor1 = new RichTextEditor("#create_description");

$(document).ready(function() {
  $('.day-select2').select2({
    dropdownParent: $("#createScheduleModal")
  });
  $('.semester-select2').select2({
    dropdownParent: $("#createScheduleModal")
  });

  $('.edit-day-select2').select2({
    dropdownParent: $("#editScheduleModal")
  });
  $('.edit-semester-select2').select2({
    dropdownParent: $("#editScheduleModal")
  });

  $(".edit-schedule-data").on("click", function() { 
    const schedule_id = $(this).closest('.table-body').find('.schedule_id').val()         
    $.ajax({
    type: "GET",
    url: `/groups/${$('.group_id').val()}/schedules/${schedule_id}`,
      dataType: "json",
      success: function({schedule, days, semesters}){         
        $("#edit-schedule-form").attr("action", `/groups/${$('.group_id').val()}/schedules/${schedule.id}`)        

        $("#edit_day").html("")
        
        days.forEach((day, index) => {
          if(index == schedule.day) {
            $("#edit_day").append(`
              <option value="${index}" selected>
                ${day}
              </option>
          `)
          } else {
            $("#edit_day").append(`
              <option value="${index}">
                ${day}
              </option>
          `)
          }
        });

        $("#edit_semester").html("")
        semesters.forEach((semester, index) => {
          if(index+1 == schedule.semester) {
            $("#edit_semester").append(`
              <option value="${index+1}" selected>
                  Semester ${semester}
              </option>
          `)
          } else {
            $("#edit_semester").append(`
              <option value="${index+1}">
                  Semester ${semester}
              </option>
          `)
          }
        });
      }
    })
  })

  $(".delete-schedule-data").on("click", function() { 
    const schedule_id = $(this).closest('.table-body').find('.schedule_id').val()       
    const group_type = $("#group_type").val()     
    $.ajax({
      type: "GET",
      url: `/groups/${$('.group_id').val()}/schedules/${schedule_id}`,
      dataType: "json",
      success: function({schedule}){         
        console.log(schedule)
        $("#delete_schedule_form").attr("action", `/groups/${$('.group_id').val()}/schedules/${schedule.id}`)
      }
    })
  })
})
