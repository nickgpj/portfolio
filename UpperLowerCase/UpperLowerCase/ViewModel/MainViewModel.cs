using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;
using UpperLowerCase.Helpers;
using UpperLowerCase.Model;

namespace UpperLowerCase.ViewModel
{
    internal class MainViewModel : ObservableObject
    {
        #region fields
        private UserMessage _userMessage;
        #endregion

        #region constructors
        public MainViewModel()
        {
            _userMessage = new() { Text = "Hello World" };
            ToggleCaseCommand = new RelayCommand(ExecuteToggleCase);
        }
        #endregion

        #region properties
        public UserMessage UserMessage
        {
            get { return _userMessage; }
            set { _userMessage = value; OnPropertyChanged(); }
        }

        #endregion

        #region commands
        public ICommand ToggleCaseCommand { get; }
        #endregion

        #region methods
        private void ExecuteToggleCase(object? obj)
        {
            if (UserMessage.Text[0] >= 'A' && UserMessage.Text[0] <= 'Z')
            {
                UserMessage.Text = UserMessage.Text.ToLower();
            }
            else
            {
                UserMessage.Text = UserMessage.Text.ToUpper();
            }
        }
        #endregion
    }
}
