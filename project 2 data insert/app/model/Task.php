<?php

function insert_task($conn, $data)
{
	$sql = "INSERT INTO tasks (title, description, assigned_to, due_date) VALUES(?,?,?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);
}

function get_all_tasks($conn)
{
	$sql = "SELECT * FROM tasks ORDER BY id DESC ";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	if ($stmt->rowCount() > 0) {
		$tasks = $stmt->fetchAll();
	} else $tasks = 0;

	return $tasks;
}
function get_all_tasks_due_today($conn)
{
	$sql = "SELECT * FROM tasks WHERE due_date = CURDATE() AND status != 'completed' ORDER BY id DESC ";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	if ($stmt->rowCount() > 0) {
		$tasks = $stmt->fetchAll();
	} else $tasks = 0;

	return $tasks;
}

function count_tasks_due_today($conn)
{
	$sql = "SELECT id FROM tasks WHERE due_date = CURDATE() AND status != 'completed'";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
}
function get_all_tasks_overdue($conn)
{
	$sql = "SELECT * FROM tasks WHERE due_date < CURDATE() AND status != 'completed' ORDER BY id DESC ";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	if ($stmt->rowCount() > 0) {
		$tasks = $stmt->fetchAll();
	} else $tasks = 0;

	return $tasks;
}

function count_tasks_overdue($conn)
{
	$sql = "SELECT id FROM tasks WHERE  due_date < CURDATE() AND status != 'completed'";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
}
function get_all_tasks_NoDeadline($conn)
{
	$sql = "SELECT * FROM tasks WHERE status != 'completed' AND due_date is null  ORDER BY id DESC ";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	if ($stmt->rowCount() > 0) {
		$tasks = $stmt->fetchAll();
	} else $tasks = 0;

	return $tasks;
}

function count_tasks_NoDeadline($conn)
{
	$sql = "SELECT id FROM tasks WHERE  status != 'completed'AND due_date is null";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
}

function delete_task($conn, $data)
{
	$sql = "DELETE FROM tasks WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);
}

function get_task_by_id($conn, $id)
{
	$sql = "SELECT * FROM tasks WHERE id =? ";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	if ($stmt->rowCount() > 0) {
		$task = $stmt->fetch();
	} else $task = 0;

	return $task;
}
function count_tasks($conn)
{
	$sql = "SELECT id FROM tasks";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
}

function update_task($conn, $data)
{
	$sql = "UPDATE tasks SET title=?, description=?, assigned_to=?, due_date=? WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);
}
function update_task_status($conn, $data)
{
	$sql = "UPDATE tasks SET status=? WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);
}

function get_all_tasks_by_id($conn, $id)
{
	$sql = "SELECT * FROM tasks where assigned_to=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	if ($stmt->rowCount() > 0) {
		$tasks = $stmt->fetchAll();
	} else $tasks = 0;

	return $tasks;
}


function count_pending_tasks($conn)
{
	$sql = "SELECT id FROM tasks WHERE status='pending'";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
}
function count_in_progress_tasks($conn)
{
	$sql = "SELECT id FROM tasks WHERE status='in_progress'";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
}
function count_completed_tasks($conn)
{
	$sql = "SELECT id FROM tasks WHERE status='completed'";
	$stmt = $conn->prepare($sql);
	$stmt->execute([]);

	return $stmt->rowCount();
}
function count_my_tasks($conn, $id)
{
	$sql = "SELECT id FROM tasks where assigned_to=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	return $stmt->rowCount();
}
function count_my_tasks_overdue($conn, $id)
{
	$sql = "SELECT id FROM tasks WHERE due_date < CURDATE() AND status != 'completed' and assigned_to=? ";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	return $stmt->rowCount();
}
function count_my_tasks_NoDeadline($conn, $id)
{
	$sql = "SELECT id FROM tasks WHERE assigned_to=? AND status != 'completed' AND due_date IS NULL";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	return $stmt->rowCount();
}

function get_all_pending_tasks($conn)
{
	$sql = "SELECT * FROM tasks WHERE status = 'pending'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll();
}
function count_my_pending_tasks($conn, $id)
{
	$sql = "SELECT id FROM tasks WHERE status='pending'AND assigned_to=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	return $stmt->rowCount();
}

function get_all_in_progress_tasks($conn)
{
	$sql = "SELECT * FROM tasks WHERE status = 'in_progress'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll();
}

function count_my_in_progress_tasks($conn, $id)
{
	$sql = "SELECT id FROM tasks WHERE status='in_progress'AND assigned_to=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	return $stmt->rowCount();
}

function get_all_completed_tasks($conn) {
    $sql = "SELECT * FROM tasks WHERE status = 'completed'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function count_my_completed_tasks($conn, $id)
{
	$sql = "SELECT id FROM tasks WHERE status='completed'AND assigned_to=?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	return $stmt->rowCount();
}

function get_tasks_by_user($conn, $user_id) {
    $sql = "SELECT * FROM tasks WHERE assigned_to = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function count_tasks_by_user($conn, $user_id) {
    $sql = "SELECT COUNT(*) as total FROM tasks WHERE assigned_to = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}
