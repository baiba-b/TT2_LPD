<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <script>
        function calculateTotalMinutes() {
            // Get the input values
            const estimatedDays = document.getElementById('estimated_days').value || 0;
            const estimatedHours = document.getElementById('estimated_hours').value || 0;
            const estimatedMinutes = document.getElementById('estimated_minutes').value || 0;

            // Calculate total minutes
            const totalEstimatedMinutes = (parseInt(estimatedDays) * 1440) + (parseInt(estimatedHours) * 60) + parseInt(estimatedMinutes);

            // Set the total minutes to the hidden input field
            document.getElementById('total_estimated_workload').value = totalEstimatedMinutes;
        }
    </script>
</head>
<body>
    <form action="{{ route('projects.store') }}" method="POST" onsubmit="calculateTotalMinutes()">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
        </div>
        <div>
            <label for="due_date">Due Date:</label>
            <input type="date" id="due_date" name="due_date">
        </div>
        <div>
            <label>Estimated Workload:</label>
            <div>
                <label for="estimated_days">Days:</label>
                <input type="number" id="estimated_days" name="estimated_days" min="0">
                <label for="estimated_hours">Hours:</label>
                <input type="number" id="estimated_hours" name="estimated_hours" min="0" max="23">
                <label for="estimated_minutes">Minutes:</label>
                <input type="number" id="estimated_minutes" name="estimated_minutes" min="0" max="59">
            </div>
        </div>
        <!-- Hidden input to store total minutes -->
        <input type="hidden" id="total_estimated_workload" name="estimated_workload">
        <button type="submit">Create Project</button>
    </form>
</body>
</html>
