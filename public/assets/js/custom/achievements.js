$(document).ready(function() {
  $('.student-select2').select2({
    dropdownParent: $("#createAchievementModal")
  });
  $('.rank-select2').select2({
    dropdownParent: $("#createAchievementModal")
  });
  $('.type-select2').select2({
    dropdownParent: $("#createAchievementModal")
  });
  $('.level-select2').select2({
    dropdownParent: $("#createAchievementModal")
  });

  $(".detail-achievement-data").on("click", function() {
    $.ajax({
        type: "GET",
        url: `/achievements/${$(this).closest('.table-body').find('.achievement_id').val()}`,
        dataType: "json",
        success: function({achievement}){
					if(achievement.image != null) $("#detail_image").attr("src", `/uploads/achievements/${achievement.image}`)

          $("#detail_student").val(achievement.student.name)
          $("#detail_title").val(achievement.title)
          $("#detail_rank").val(
            achievement.rank == 1 ? '1st place' :
            achievement.rank == 2 ? '2nd place' :
            achievement.rank == 3 ? '3rd place' :
            achievement.rank == 4 ? '4th place' :
            achievement.rank == 5 ? '5th place' : '6th place'
          )
          $("#detail_organizer").val(achievement.organizer)
          $("#detail_type").val(achievement.type == 1 ? 'Academic':'Non-Academic')
          $("#detail_level").val(
            achievement.level == 1 ? 'School' :
            achievement.level == 2 ? 'Subdistrict' :
            achievement.level == 3 ? 'District/City' :
            achievement.level == 4 ? 'Province' :
            achievement.level == 5 ? 'National' : 'International'
          )
          $("#detail_date").val(formatDate(achievement.date))
        }
    })
  })

  $(".edit-achievement-data").on("click", function() {
    const achievement_id = $(this).closest('.table-body').find('.achievement_id').val()
    $.ajax({
    type: "GET",
      url: `/achievements/${achievement_id}`,
      dataType: "json",
      success: function({achievement, students, ranks, types, levels}){
        $("#edit_achievement_form").attr("action", `/achievements/${achievement.id}`)
				if(achievement.image != null) $("#edit_image_preview").attr("src", `/uploads/achievements/${achievement.image}`)

        $("#edit_title").val(achievement.title)
        $("#edit_organizer").val(achievement.organizer)
        $("#edit_date").val(showInputDate(achievement.date))

        $("#edit_student_id").html("")
        students.forEach(student => {
          if(student.id == achievement.student_id) {
            $("#edit_student_id").append(`
              <option value="${student.id}" selected>
                  ${student.name}
              </option>
          `)
          } else {
            $("#edit_student_id").append(`
              <option value="${student.id}">
                  ${student.name}
              </option>
          `)
          }
        });

        $("#edit_rank").html("")
        ranks.forEach((rank, index) => {
          if(index+1 == achievement.rank) {
            $("#edit_rank").append(`
              <option value="${index+1}" selected>
                  ${rank}
              </option>
          `)
          } else {
            $("#edit_rank").append(`
              <option value="${index+1}">
                  ${rank}
              </option>
          `)
          }
        });

        $("#edit_type").html("")
        types.forEach((type, index) => {
          if(index+1 == achievement.type) {
            $("#edit_type").append(`
              <option value="${index+1}" selected>
                  ${type}
              </option>
          `)
          } else {
            $("#edit_type").append(`
              <option value="${index+1}">
                  ${type}
              </option>
          `)
          }
        });

        $("#edit_level").html("")
        levels.forEach((level, index) => {
          if(index+1 == achievement.level) {
            $("#edit_level").append(`
              <option value="${index+1}" selected>
                  ${level}
              </option>
          `)
          } else {
            $("#edit_level").append(`
              <option value="${index+1}">
                  ${level}
              </option>
          `)
          }
        });

      }
    })
  })

  $(".delete-achievement-data").on("click", function() {
    const achievement_id = $(this).closest('.table-body').find('.achievement_id').val()
    $("#delete_achievement_form").attr("action", `/achievements/${achievement_id}`)
  })
})

previewImg("create-achievement-input", "create-achievement-preview-img")
previewImg("edit-achievement-input", "edit-achievement-preview-img")
