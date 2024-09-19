using System.Configuration;
using System.Data;
using System.Windows;
using TellerApp.View;
using TellerApp.ViewModel;

namespace TellerApp
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
