using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;
using TellerApp.Helpers;
using TellerApp.Model;

namespace TellerApp.ViewModel
{
    internal class MainViewModel : ObservableObject
    {
        #region fields

        private Teller _teller;

        #endregion

        #region constructors

        public MainViewModel()
        {
            Teller = new()
            {
                Tel = 0
            };
            IncrementCommand = new RelayCommand(ExecuteIncrement, CanExecuteIncrement);
            ResetCommand = new RelayCommand(ExecuteReset);
            
        }

        #endregion

        #region properties

        public Teller Teller 
        {
            get => _teller;
            set
            {  
                if (_teller != value)
                {
                    _teller = value;
                    OnPropertyChanged();
                }
            }
        }

        #endregion

        #region commands
        
        public ICommand IncrementCommand { get; }
        public ICommand ResetCommand { get; }
        
        #endregion

        #region methods

        private void ExecuteIncrement(object parameter)
        {
            if (CanExecuteIncrement(parameter))
            {
                Teller.Tel++;
            }
        }

        private bool CanExecuteIncrement(object parameter)
        {
            return Teller.Tel < 25;
        }

        private void ExecuteReset(object parameter)
        {
           Teller.Tel = 0;
        }
        #endregion
    }
}
