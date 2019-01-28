import requests
import subprocess

organisation="tryton"
repo_count = 10000

repo_data = requests.get(
    "https://api.github.com/orgs/{organisation}/repos?per_page={repo_count}".format(
        organisation=organisation, repo_count=repo_count))
print(repo_data.json())
for repo in repo_data.json():

    proc = subprocess.Popen(
        ["git", "clone", repo['html_url'], "--branch", "5.0"],
        stdout=subprocess.PIPE
    )
    proc.communicate()
