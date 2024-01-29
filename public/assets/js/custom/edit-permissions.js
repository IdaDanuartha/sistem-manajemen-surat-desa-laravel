$(document).ready(function() {
  $('.student-select2').select2();  
  $('.schedule-select2').select2();  
  $('.end-schedule-select2').select2();  
  $('.security-select2').select2();  

  $.ajax({
    type: "GET",
    url: `/students/${$(".student_id").val()}`,
    dataType: "json",
    success: function({student}){     
      const date = new Date()
      const schedule_today = student.group.schedules.filter((schedule) => schedule.day == date.getDay())[0]
      const schedule_details = schedule_today.lesson_schedule_details      
      
      $(".schedule-select2").on("change", function() {
        const get_schedule_detail = schedule_details.filter(schedule => schedule.id == $(this).val())[0]
        
        $(".input-teacher-name").val(get_schedule_detail.subject_teacher.teacher.name)

        const end_schedule_details = schedule_details.filter(schedule => schedule.id > $(this).val())
        
        $(".end-schedule-select2").html("")
        $(".end-schedule-select2").append(`<option value="">Pilih Jam</option>`)

        if(end_schedule_details.length > 0) {
          end_schedule_details.forEach(schedule => {            
            $(".end-schedule-select2").append(`
              <option value="${schedule.id}">
                ${formatTime(schedule.start_time)} - ${formatTime(schedule.end_time)}
              </option>
            `)        
          });
        } else {
          const get_subject_teachers = schedule_details.filter(schedule => schedule.id >= $(".schedule-select2").val() && schedule.id <= $(this).val())
          // console.log(get_subject_teachers)
          $(".input-subject-teacher").html("")
          get_subject_teachers.forEach((item, index) => {
            $(".input-subject-teacher").append(`${index+1}. ${item.subject_teacher.subject.name} - ${item.subject_teacher.teacher.name} (${formatTime(item.start_time)} - ${formatTime(item.end_time)})\n`)
          })
        }
      })

      $(".end-schedule-select2").on("change", function () {
        const get_subject_teachers = schedule_details.filter(schedule => schedule.id >= $(".schedule-select2").val() && schedule.id <= $(this).val())
        // console.log(get_subject_teachers)
        $(".input-subject-teacher").html("")
        get_subject_teachers.forEach((item, index) => {
          $(".input-subject-teacher").append(`${index+1}. ${item.subject_teacher.subject.name} - ${item.subject_teacher.teacher.name} (${formatTime(item.start_time)} - ${formatTime(item.end_time)})\n`)
        })
      })
    }
  })

})