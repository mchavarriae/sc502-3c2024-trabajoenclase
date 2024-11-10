document.addEventListener('DOMContentLoaded', function () {

    const API_URL = 'http://localhost:8000/semana10/prework/app-tareas/backend/tasks.php';

    let isEditMode = false;
    let edittingId;
    let tasks = []
    

    async function loadTasks() {
        try {
            const response = await fetch(API_URL, {
                method: 'GET',
                credentials: 'include' // Para enviar las cookies de sesión
            });
            if (response.ok) {
                tasks = await response.json();
                renderTasks(tasks);
            } else {
                if(response.status === 401){
                    //enviar al usuario a login si no hay sesion
                    window.location.href = "index.html";
                }
                console.error("Error al obtener las tareas");
            }
        } catch (error) {
            console.error("Error en la solicitud:", error);
        }
    }
    

    function renderTasks(tasks) {
        const taskList = document.getElementById('task-list');
        taskList.innerHTML = '';
        tasks.forEach(function (task) {

            let commentsList = '';
            if (task.comments && task.comments.length > 0) {
                commentsList = '<ul class="list-group list-group-flush">';
                task.comments.forEach(comment => {
                    commentsList += `<li class="list-group-item">${comment.description} 
                    <button type="button" class="btn btn-sm btn-link remove-comment" data-visitid="${task.id}" data-commentid="${comment.id}">Remove</button>
                    </li>`;
                }); 
                commentsList += '</ul>';
            }
            const taskCard = document.createElement('div');
            taskCard.className = 'col-md-4 mb-3';
            taskCard.innerHTML = `
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">${task.title}</h5>
                    <p class="card-text">${task.description}</p>
                    <p class="card-text"><small class="text-muted">Due: ${task.due_date}</small> </p>
                    ${commentsList}
                     <button type="button" class="btn btn-sm btn-link add-comment"  data-id="${task.id}">Add Comment</button>

                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button class="btn btn-secondary btn-sm edit-task"data-id="${task.id}">Edit</button>
                    <button class="btn btn-danger btn-sm delete-task" data-id="${task.id}">Delete</button>
                </div>
            </div>
            `;
            taskList.appendChild(taskCard);
        });

        document.querySelectorAll('.edit-task').forEach(function (button) {
            button.addEventListener('click', handleEditTask);
        });

        document.querySelectorAll('.delete-task').forEach(function (button) {
            button.addEventListener('click', handleDeleteTask);
        });

        document.querySelectorAll('.add-comment').forEach(function (button) {
            button.addEventListener('click', function (e) {
                // alert(e.target.dataset.id);
                document.getElementById("comment-task-id").value = e.target.dataset.id;
                const modal = new bootstrap.Modal(document.getElementById("commentModal"));
            modal.show()

            })
        });
        document.querySelectorAll('.remove-comment').forEach(function (button) {
            button.addEventListener('click', function (e) {
                let taskId = parseInt(e.target.dataset.visitid);
                let commentId = parseInt(e.target.dataset.commentid);
                selectedTask = tasks.find(t => t.id === taskId);
                commentIndex = selectedTask.comments.findIndex(c => c.id === commentId);
                selectedTask.comments.splice(commentIndex,1);
                loadTasks();
            })
        });
    }

    function handleEditTask(event) {
        try {
            // alert(event.target.dataset.id);
            //localizar la tarea quieren editar
            const taskId = parseInt(event.target.dataset.id);
            const task = tasks.find(t => t.id === taskId);
            //cargar los datos en el formulario 
            document.getElementById('task-title').value = task.title;
            document.getElementById('task-desc').value = task.description;
            document.getElementById('due-date').value = task.due_date;
            //ponerlo en modo edicion
            isEditMode = true;
            edittingId = taskId;
            //mostrar el modal
            const modal = new bootstrap.Modal(document.getElementById("taskModal"));
            modal.show();


        } catch (error) {
            alert("Error trying to edit a task");
            console.error(error);
        }
    }


    async function handleDeleteTask(event) {
        const id = parseInt(event.target.dataset.id);
        
        try {
            const response = await fetch(`${API_URL}/${id}`, {
                method: 'DELETE',
                credentials: 'include'
            });
            
            if (response.ok) {
                loadTasks(); // Recargar las tareas después de eliminar una
            } else {
                if(response.status === 401){
                    //enviar al usuario a login si no hay sesion
                    window.location.href = "index.html";
                }
            }
        } catch (error) {
            console.error("Error en la solicitud:", error);
        }
    }
    

    document.getElementById('comment-form').addEventListener('submit', function (e){
        e.preventDefault();
        const comment = document.getElementById('task-comment').value;
        const selectedTask = parseInt(document.getElementById('comment-task-id').value);
        const task = tasks.find(t=> t.id === selectedTask);


        let nextCommentId = 1;
         
        if(task.comments){
            nextCommentId = task.comments.length + 1;
        }else{
            task.comments = [];
        }
        
        task.comments.push({id: nextCommentId, description: comment});
        const modal = bootstrap.Modal.getInstance(document.getElementById('commentModal'));
        modal.hide();
        loadTasks();

    })

    document.getElementById('task-form').addEventListener('submit', async function (e) {
        e.preventDefault();

        const title = document.getElementById("task-title").value;
        const description = document.getElementById("task-desc").value;
        const dueDate = document.getElementById("due-date").value;

        try {
            const method = isEditMode ? 'PUT' : 'POST';
            const url = isEditMode ? `${API_URL}/${edittingId}` : API_URL;
            
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    title: title,
                    description: description,
                    due_date: dueDate
                }),
                credentials: 'include'
            });
            
            if (response.ok) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('taskModal'));
                modal.hide();
                loadTasks();
            } else {
                console.error("Error al guardar la tarea");
            }
        } catch (error) {
            console.error("Error en la solicitud:", error);
        }
    });

    document.getElementById('commentModal').addEventListener('show.bs.modal', function(){
        document.getElementById('comment-form').reset();
    })

    document.getElementById('taskModal').addEventListener('show.bs.modal', function () {
        if (!isEditMode) {
            document.getElementById('task-form').reset();
            // document.getElementById('task-title').value = "";
            // document.getElementById('task-desc').value = "";
            // document.getElementById('due-date').value = "";
        }
    });

    document.getElementById("taskModal").addEventListener('hidden.bs.modal', function () {
        edittingId = null;
        isEditMode = false;
    })
    loadTasks();

});