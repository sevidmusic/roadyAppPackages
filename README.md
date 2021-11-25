# roadyAppPackages

A collection of App Packages that can be made into Roady Apps
via `rig --make-app-package`.

Note: roady must be installed and setup to use these Apps.
For a guide on installing and setting up roady visit

[https://roady.tech?request=getting-started](https://roady.tech?request=getting-started)

For example, if the roadyAppPackages library is installed at
`~/roady/vendor/darling/roady-app-packages`, then to make the 
AppInfo app:

```
rig --make-app-package \
    --path ~/roady/vendor/darling/roady-app-packages/AppInfo
```

Another example, if the roadyAppPackages library is installed at
`~/roady/vendor/darling/roady-app-packages`, then to make the 
AppPackager app:

```
rig --make-app-package \
    --path ~/roady/vendor/darling/roady-app-packages/AppPackager
```
