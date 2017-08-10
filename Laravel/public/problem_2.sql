SELECT title, count(students.id) AS num_students FROM majors
LEFT OUTER JOIN students ON students.major_id = majors.id
GROUP BY majors.id;