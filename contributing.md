# Contributing to Edu app


EduApp is a community driven project and accepts contributions of code and documentation from the community. These contributions are made in the form of Issues or [Pull Requests](http://help.github.com/send-pull-requests/) on the [EduApp repository](https://github.com/gopalindians/edu-app>) on GitHub.

Issues are a quick way to point out a bug. If you find a bug or documentation error in EduApp then please check a few things first:

1. There is not already an open Issue
2. The issue has already been fixed (check the develop branch, or look for closed Issues)
3. Is it something really obvious that you can fix yourself?

Reporting issues is helpful but an even better approach is to send a Pull Request, which is done by "Forking" the main repository and committing to your own copy. This will require you to use the version control system called Git.

## Guidelines

Before we look into how, here are the guidelines. If your Pull Requests fail
to pass these guidelines it will be declined and you will need to re-submit
when you’ve made the changes. This might sound a bit tough, but it is required
for us to maintain quality of the code-base.

### Documentation

If you change anything that requires a change to documentation then you will need to add it. New classes, methods, parameters, changing default values, etc are all things that will require a change to documentation. The change-log must also be updated for every change. Also PHPDoc blocks must be maintained.

### Compatibility

EduApp recommends PHP 7.0 or newer to be used

### Branching

EduApp uses the [Git-Flow](http://nvie.com/posts/a-successful-git-branching-model/) branching model which requires all pull requests to be sent to the "develop" branch. This is
where the next planned version will be developed. The "master" branch will always contain the latest stable version and is kept clean so a "hotfix" (e.g: an emergency security patch) can be applied to master to create a new version, without worrying about other features holding it up. For this reason all commits need to be made to "develop" and any sent to "master" will be closed automatically. If you have multiple changes to submit, please place all changes into their own branch on your fork.

One thing at a time: A pull request should only contain one change. That does not mean only one commit, but one change - however many commits it took. The reason for this is that if you change X and Y but send a pull request for both at the same time, we might really want X but disagree with Y, meaning we cannot merge the request. Using the Git-Flow branching model you can create new branches for both of these features and send two requests.

### Signing

You must sign your work, certifying that you either wrote the work or otherwise have the right to pass it on to an open source project. git makes this trivial as you merely have to use `--signoff` on your commits to your EduApp fork.

`git commit --signoff`

or simply

`git commit -s`

This will sign your commits with the information setup in your git config, e.g.

`Signed-off-by: Gopal Sharma <gopalindians@gmail.com>`

If you are using [Tower](http://www.git-tower.com/) there is a "Sign-Off" checkbox in the commit window. You could even alias git commit to use the `-s` flag so you don’t have to think about it.

### Keeping your fork up-to-date

Unlike systems like Subversion, Git can have multiple remotes. A remote is the name for a URL of a Git repository. By default your fork will have a remote named "origin" which points to your fork, but you can add another remote named "EduApp" which points to `git://github.com/gopalindians/edu-app.git`. This is a read-only remote but you can pull from this develop branch to update your own.

If you are using command-line you can do the following:

1. `git remote add edu_app git://github.com/gopalindians/edu-app.git`
2. `git pull edu_app master`
3. `git push origin master`

Now your fork is up to date. This should be done regularly, or before you send a pull request at least.