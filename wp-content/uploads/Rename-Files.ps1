# Specify the root path
$rootPath = "E:\xampp\htdocs\paczka\wp-content\uploads"

# Get all files with ".bk" in their names recursively
$files = Get-ChildItem -Path $rootPath -Recurse -Filter *.bk*

# Loop through each file
foreach ($file in $files) {
    # Get the file extension
    $extension = $file.Extension

    # Generate the new name by replacing ".bk" with "_1"
    $newName = $file.Name -replace '\.bk', '_1'

    # Construct the new path
    $newPath = Join-Path -Path $file.DirectoryName -ChildPath $newName

    # Rename the file
    Rename-Item -Path $file.FullName -NewName $newPath -Force
    Write-Host "Renamed: $($file.FullName) to $($newPath)"
}
