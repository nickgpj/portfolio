using EindopdrachtDD1.Helpers;
using EindopdrachtDD1.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;

namespace EindopdrachtDD1.ViewModel
{
    internal class MainViewModel : ObservableObject
    {
        #region fields
        private UserMessage _userMessage;
        private object _activeViewModel;
        #endregion

        #region constructors
        public MainViewModel()
        {
            _activeViewModel = new ContactInfoViewModel();
            ShowContactCommand = new RelayCommand(ExecuteShowContactInfo);
            ShowCharactersCommand = new RelayCommand(ExecuteShowCharacters);
            ShowGamesCommand = new RelayCommand(ExecuteShowGames);
            _userMessage = new() { Text = "Standaard MVVM template" };
        }
        #endregion

        #region properties
        public UserMessage UserMessage
        {
            get { return _userMessage; }
            set { _userMessage = value; OnPropertyChanged(); }
        }

        public object ActiveViewModel
        {
            get { return _activeViewModel; }
            set { _activeViewModel = value; OnPropertyChanged(); }
        }
        #endregion

        #region commands
        public ICommand ShowContactCommand { get; }

        public ICommand ShowCharactersCommand { get; }

        public ICommand ShowGamesCommand { get; }
        #endregion

        #region methods
        private void ExecuteShowContactInfo(object? obj)
        {
            ActiveViewModel = new ContactInfoViewModel();
        }

        private void ExecuteShowCharacters(object? obj)
        {
            ActiveViewModel = new CharactersViewModel();
        }

        private void ExecuteShowGames(object? obj)
        {
            ActiveViewModel = new GamesViewModel();
        }
        #endregion
    }
}
