// hit data

const hitData = (urlPost, dataPost, typePost) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: urlPost,
            type: typePost,
            data: dataPost,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Accept: "application/json",
            },
            success: (response) => {
                resolve(response);
            },
            error: (error) => {
                reject(error);
            },
        });
    });
};

// get all data

const getUserData = async () => {
    try {
        const response = await hitData("/api/user", null, "GET");
        $("#data-user").html("");
        var data = response.data;

        toastr.success(response.message);
        data.usersData.reverse();
        data.usersData.forEach((userData) => {
            var role =
                userData.role == "1"
                    ? "Admin"
                    : userData.role == "2"
                    ? "Guru"
                    : "Siswa";
            var status =
                userData.active == "1"
                    ? ["success", "Active"]
                    : ["danger", "Non Active"];
            return $("#data-user").append(`<tr>
            <td>${userData.username}</th>
            <td>${userData.email}</th>
            <td>${role}</th>
            <td><span class="badge badge-${status[0]}">${status[1]}</span></th>
            <td>${userData.diff_created}</th>
            <td class="d-flex justify-content-center">
                <button class="btn btn-warning btn-sm" onclick="updateUser(${userData.id})"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </th>
            </tr>`);
        });
    } catch (error) {
        console.log(error);
    }
};

// user by id
const getUserDataById = async (userId) => {
    try {
        const response = await hitData(`/api/user/${userId}`, null, "GET");
        return response.data.userData;
    } catch (error) {
        console.log(error);
    }
};

const createNewUser = async (dataPost) => {
    try {
        const response = await hitData("/api/user", dataPost, "POST");
        $('#create-user-form button[type="submit"]').attr("disabled", false);

        console.log(response);
        toastr.success(response.message);
        $("#create-user-modal").modal("hide");
        getUserData();
    } catch (error) {
        console.log(error);

        if (error.responseJSON.errors) {
            var errorsResponse = error.responseJSON;
            toastr.error(errorsResponse.message);

            for (var i in errorsResponse.errors) {
                $(`#${i}`).addClass("is-invalid");

                for (var j in errorsResponse.errors[i]) {
                    $(`#${i}-field .invalid-feedback`).html(
                        `${errorsResponse.errors[i][j]}`
                    );
                }
            }
        }

        $('#create-user-form button[type="submit"]').attr("disabled", false);

        getUserData();
    }
};

// update user
const updateUserData = async (dataPost) => {
    try {
        const response = await hitData(
            `/api/user/${dataPost.id}`,
            dataPost,
            "PUT"
        );
        $('#edit-user-form button[type="submit"]').attr("disabled", false);

        toastr.success(response.message);
        $("#edit-user-modal").modal("hide");
        getUserData();
    } catch (error) {
        console.log(error);

        if (error.responseJSON.errors) {
            var errorsResponse = error.responseJSON;
            toastr.error(errorsResponse.message);

            for (var i in errorsResponse.errors) {
                $(`#${i}`).addClass("is-invalid");

                for (var j in errorsResponse.errors[i]) {
                    $(`#${i}-field .invalid-feedback`).html(
                        `${errorsResponse.errors[i][j]}`
                    );
                }
            }
        }

        $('#edit-user-form button[type="submit"]').attr("disabled", false);

        getUserData();
    }
};

// call when $ ready
$(document).ready(function () {
    getUserData();
    window.localStorage.clear()
    $("#table")
        .DataTable({
            ordering: false,
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            info: false,
            paging: false,
            searching: false,
            buttons: [
                {
                    text: '<i class="fas fa-plus"></i> Tambah Pengguna',
                    className: "btn-primary",
                    action: function (e, dt, node, config) {
                        $("#create-user-modal").modal("show");
                    },
                },
                {
                    text: '<i class="fas fa-sync-alt"></i> Reload',
                    className: "btn-secondary",
                    action: function (e, dt, node, config) {
                        getUserData();
                    },
                },
            ],
        })
        .buttons()
        .container()
        .appendTo("#table_wrapper .col-md-6:eq(0)");

    $("#create-user-form").on("submit", function (e) {
        e.preventDefault();
        var data = {
            username: $('input[id="username"]').val(),
            email: $('input[id="email"]').val(),
            role: $('select[id="role"]').val(),
            password: "SIAJAR32",
        };
        $('#create-user-form button[type="submit"]').attr("disabled", true);
        createNewUser(data);
    });

    $("#edit-user-form").on("submit", function (e) {
        e.preventDefault();

        var dataPost = {
            id: $('#edit-user-form input[id="userId"]').val(),
            username: $('#edit-user-form input[id="username"]').val(),
            email: $('#edit-user-form input[id="email"]').val(),
            role: $('#edit-user-form select[id="role"]').val(),
        };
        $('#edit-user-form button[type="submit"]').attr("disabled", true);
        updateUserData(dataPost);
    });
});

const updateUser = async (userId) => {
    try {
        let response = await getUserDataById(userId);
        $("#edit-user-modal").modal("show");

        $('#edit-user-form input[id="userId"]').val(response.id);
        $('#edit-user-form input[id="username"]').val(response.username);
        $('#edit-user-form input[id="email"]').val(response.email);
        $('#edit-user-form select[id="role"]').val(response.role);

        response = "";
    } catch (error) {
        console.log(error);
    }
};