using System.Configuration;
using System.Data;
using System.Windows;
using UpperLowerCase.View;
using UpperLowerCase.ViewModel;

namespace UpperLowerCase
{
    /// <summary>
    /// Interaction logic for App.xaml
    /// </summary>
    public partial class App : Application
    {
        protected override void OnStartup(StartupEventArgs e)
        {
            base.OnStartup(e);
            MainWindow = new MainView()
            {
                DataContext = new MainViewModel()
            };
            MainWindow.Show();
        }
    }

}
